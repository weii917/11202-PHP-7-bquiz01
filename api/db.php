<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db01";
    // protected $dsn = "mysql:host=localhost;charset=utf8;dbname=bquiz";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
        // $this->pdo = new PDO($this->dsn, 's1120412', 's1120412');
    }

    function all($where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function count($where = '', $other = '')
    {
        $sql = "select count(*) from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    private function math($math, $col, $array = '', $other = '')
    {
        $sql = "select $math(`$col`) from `$this->table`";
        $sql = $this->sql_all($sql, $array, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col = '', $where = '', $other = '')
    {
        return  $this->math('sum', $col, $where, $other);
    }
    function max($col, $where = '', $other = '')
    {
        return  $this->math('max', $col, $where, $other);
    }
    function min($col, $where = '', $other = '')
    {
        return  $this->math('min', $col, $where, $other);
    }


    function find($id)
    {

        $sql = "select * from `$this->table` ";

        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        }
        //echo 'find=>'.$sql;
        $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    // 判斷是否有id欄位有id更新資料，指定where條件的id，沒有id就是新增資料
    function save($array)
    {
        if (isset($array['id'])) {
            $sql = "update `$this->table` set ";

            if (!empty($array)) {
                $tmp = $this->a2s($array);
            }
            $sql .= join(",", $tmp);
            $sql .= " where `id`='{$array['id']}'";
        } else {
            $sql = "insert into `$this->table` ";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";

            $sql = $sql . $cols . " values " . $vals;
        }
        return $this->pdo->exec($sql);
    }


    function del($id)
    {

        $sql = "delete from `$this->table` where ";

        if (is_array($id)) {

            $tmp = $this->a2s($id);
            $sql .= join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " `id`='$id'";
        }
        //echo $sql;

        return $this->pdo->exec($sql);
    }
    // 用來查找沒有在上述自訂function，查找其他的可以使用
    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    //轉換陣列顯示的方式`$col`='$value'存放在新的$tmp陣列，這個值在用各個語法的方式取用
    private function a2s($array)
    {
        foreach ($array as $col => $value) {
            //檢查變數是否有特殊符號
            $value = $this->check($value);
            $tmp[] = "`$col`='$value'";
        }
        return $tmp;
    }

    private function sql_all($sql, $array, $other)
    {
        if (isset($this->table) && !empty($this->table)) {

            if (is_array($array)) {
                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array";
            }

            $sql .= $other;
            //echo 'all=>'.$sql;
            // $rows = $this->pdo->query($sql)->fetchColumn();
            return $sql;
        }
    }
    /**檢查及處理所有的參數 */
    function check($arg)
    {
        $arg = htmlspecialchars($arg);
        return $arg;
    }
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url)
{
    header("location:$url");
}
$Title = new DB('titles');
$Total = new DB('total');
$Bottom = new DB('bottom');
$Ad = new DB('ad');
$Mvim = new DB('mvim');
$Image = new DB('image');
$News = new DB('news');
$Admin = new DB('admin');
$Menu = new DB('menu');

//$tables=array_keys(get_defined_vars());
/* dd($tables); */
// 如果網址存在do變數，用此變數轉換為首字大寫ucfirst
// 如果存在首字大寫變數名稱，就賦予$DB，否則以$Title賦予
if (isset($_GET['do'])) {
    //$key=ucfirst($_GET['do']);

    if (isset(${ucfirst($_GET['do'])})) {
        $DB = ${ucfirst($_GET['do'])};
    }
    /* if(in_array($key,$tables)){
        $DB=$$key;
    } */
} else {
    $DB = $Title;
}

// 紀錄進站人數，如果不存在SESSION的visited，資料庫的total加1，並賦予SESSION的visited存在值
// 直到關掉瀏覽器都不會再加1

// if(!isset($_SESSION['visited'])){
//     $Total->q("update `total` set `total`=`total`+1 where `id`=1");
//     $_SESSION['visited']=1;

// }
if (!isset($_SESSION['visited'])) {
    $Total->q("update `total` set `total` = `total`+1 where `id`=1");
    $_SESSION['visited'] = 1;
}
