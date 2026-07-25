<?php
if (!function_exists('download_sample_xlsx')) {
    function download_sample_xlsx($filename, $headers, $rows = [], $required_map = [])
    {
        if (!class_exists('ZipArchive')) {
            header('Content-Type: text/plain; charset=utf-8');
            echo 'ZipArchive extension is required for XLSX download.';
            exit;
        }

        $xml_escape = function ($value) {
            return htmlspecialchars((string) $value, ENT_QUOTES | ENT_XML1, 'UTF-8');
        };

        $col_to_name = function ($index) {
            $index = intval($index);
            $name = '';
            while ($index >= 0) {
                $name = chr(($index % 26) + 65) . $name;
                $index = intdiv($index, 26) - 1;
            }
            return $name;
        };

        $build_row = function ($row_index, $values, $is_header = false) use ($xml_escape, $col_to_name, $required_map) {
            $row_xml = '<row r="' . $row_index . '">';
            $cell_count = count($values);
            for ($i = 0; $i < $cell_count; $i++) {
                $cell_ref = $col_to_name($i) . $row_index;
                $val = $xml_escape($values[$i] ?? '');
                $style = 0;
                if ($is_header) {
                    $header_key = strtolower(trim((string) ($values[$i] ?? '')));
                    $style = !empty($required_map[$header_key]) ? 1 : 2;
                }
                $row_xml .= '<c r="' . $cell_ref . '" t="inlineStr" s="' . $style . '"><is><t>' . $val . '</t></is></c>';
            }
            $row_xml .= '</row>';
            return $row_xml;
        };

        $sheet_rows = [];
        $sheet_rows[] = $build_row(1, $headers, true);
        $row_num = 2;
        foreach ($rows as $row) {
            $sheet_rows[] = $build_row($row_num, $row, false);
            $row_num++;
        }

        $sheet_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<sheetData>' . implode('', $sheet_rows) . '</sheetData>'
            . '</worksheet>';

        $styles_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<fonts count="3">'
            . '<font><sz val="11"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="11"/><name val="Calibri"/></font>'
            . '</fonts>'
            . '<fills count="4">'
            . '<fill><patternFill patternType="none"/></fill>'
            . '<fill><patternFill patternType="gray125"/></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FFEF4444"/><bgColor indexed="64"/></patternFill></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FFEFF2F7"/><bgColor indexed="64"/></patternFill></fill>'
            . '</fills>'
            . '<borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders>'
            . '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
            . '<cellXfs count="3">'
            . '<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
            . '<xf numFmtId="0" fontId="1" fillId="2" borderId="0" xfId="0" applyFont="1" applyFill="1"/>'
            . '<xf numFmtId="0" fontId="2" fillId="3" borderId="0" xfId="0" applyFont="1" applyFill="1"/>'
            . '</cellXfs>'
            . '</styleSheet>';

        $workbook_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" '
            . 'xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            . '<sheets><sheet name="Sample" sheetId="1" r:id="rId1"/></sheets>'
            . '</workbook>';

        $content_types_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            . '<Default Extension="xml" ContentType="application/xml"/>'
            . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            . '</Types>';

        $rels_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            . '</Relationships>';

        $workbook_rels_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
            . '</Relationships>';

        $tmp_file = tempnam(sys_get_temp_dir(), 'xlsx_');
        $zip = new ZipArchive();
        $zip->open($tmp_file, ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', $content_types_xml);
        $zip->addFromString('_rels/.rels', $rels_xml);
        $zip->addFromString('xl/workbook.xml', $workbook_xml);
        $zip->addFromString('xl/_rels/workbook.xml.rels', $workbook_rels_xml);
        $zip->addFromString('xl/styles.xml', $styles_xml);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet_xml);
        $zip->close();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($tmp_file));
        header('Cache-Control: max-age=0');
        readfile($tmp_file);
        @unlink($tmp_file);
        exit;
    }
}

