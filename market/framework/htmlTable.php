<?php
require_once ("framework/MySQLDB.php");
require_once ("interfaces/IGeneralHtmlPrinter.php");
require_once ("interfaces/ISellerHtmlPrinter.php");

class HtmlTable implements IGeneralHtmlPrinter, ISellerHtmlPrinter
{
    var $results;
    var $title = null;
    var $table = null;

    function __construct($resultSet)
    {
        $this->results = $resultSet;
    }

    public function setTitle($theTitle)
    {
        $this->title = $theTitle;
    }

    public function setTableType($account_type)
    {
        $this->table = $account_type;
    }

    // Create an html table from the result set
    public function getHTML($params)
    {
        $html = '';
        if ($this->table == "buyer")
        {
            $html .= '<p class="mb-5" style ="color: #7c73e6">To <b>add/ activate</b> buyers/sellers, please click "no" in the Activated column for each user.</p>';
        }

        $html .= '<table' . (($this->title == null) ? '' : " title=\"$this->title\"") . ' class="table">';

        $html .= $this->headerRow($params);
        $rowClass = "odd"; // odd if odd numbered row, else even
        while ($row = $this
            ->results
            ->fetch())
        {
            $html .= $this->detailRow($params, $row, $rowClass);
            $rowClass = ($rowClass == 'odd') ? 'even' : 'odd';
        }
        return $html . '</table>' . PHP_EOL;
    }

    public function getHTMLForSeller($params)
    {
        $html = '<table' . (($this->title == null) ? '' : " title=\"$this->title\"") . ' class="table">';

        $html .= $this->headerRow($params);
        $rowClass = "odd"; // odd if odd numbered row, else even
        while ($row = $this
            ->results
            ->fetch())
        {
            $html .= $this->detailRow($params, $row, $rowClass);
            $rowClass = ($rowClass == 'odd') ? 'even' : 'odd';
        }

        return $html . '</table><a href="addProduct.php"><button type="button" class="btn my-button mt-4 mb-3">Add product</button></a>' . PHP_EOL;
    }

    // make an HTML header row with the headings
    private function headerRow($params)
    {
        $ans = "<tr>" . PHP_EOL;
        foreach ($params as $key => $value)
        {
            $ans .= "<th>$value</th>" . PHP_EOL;
        }
        return $ans . '</tr>' . PHP_EOL;;
    }

    // make an HTML table row for each database row
    private function detailRow($params, $row, $rowClass)
    {
        $ans = '<tr class="' . $rowClass . '">' . PHP_EOL;
        foreach ($params as $key => $value)
        {
            $ans .= $this->applyTemplate($row, $key);
        }
        $ans .= "</tr>" . PHP_EOL;
        return $ans;
    }

    /*
    This is a bit complex - take your time reading it.
    The basic idea is that the template will look like this
    "some text <<field1>> and some more text then <<field2>> etc" 
    We'll identify the fields <<fieldname>> and replace them by the
    value of fieldname in the database row.
    */
    // make a table entry from the template and the database row
    private function applyTemplate($row, $template)
    {
        if ($template == 'productName')
        {
            return '<td class="' . $template . '"><a href="product.php?productId=' . $row['productId'] . '">' . $row[$template] . '</a></td>' . PHP_EOL;
        }
        if (($template == 'activated') && ($row[$template] == "no"))
        {
            if ($this->table == "buyer")
            {
                return '<td class="' . $template . '"><a href="activateBuyer.php?userId=' . $row['userId'] . '">' . $row[$template] . '</a></td>' . PHP_EOL;
            }
            elseif ($this->table == "seller")
            {
                return '<td class="' . $template . '"><a href="activateSeller.php?userId=' . $row['userId'] . '">' . $row[$template] . '</a></td>' . PHP_EOL;
            }
        }
        return '<td class="' . $template . '">' . $row[$template] . '</td>' . PHP_EOL;
    }

    //	we have to format $field as per format
    /* private function getFormattedField($field, $format)
    {
        //print "<!-- Params are $field,$format -->";
        switch ($format)
        {
            case 'currency':
                return '$' . number_format($field, 2);
            case 'integer':
                return number_format($field);
            case 'decimal':
                return number_format($field, 2);
            case 'date':
                $d = strtotime($field);
                return date('d-M-Y', $d);
            case 'sdate':
                $d = strtotime($field);
                return date('d-M', $d);

            default:
                return $field;
        }
    } */
}
?>
