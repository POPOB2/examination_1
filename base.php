<?php
date_default_timezone_set("Asia/Taipei");
session_start();
$do=$_GET['do']??'title';
class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db102201";
    protected $user='root';
    protected $pw='';
    // $table為一個null, 若執行該classDB時, 該classDB內帶有__construct的function()會自動執行
    // 若給了__construct一個參數, 就是給$table一個值
    protected $table; 
    protected $pdo;

    public function __construct($table)
    {
        // this->table設置一個類的屬性, 其值為$table(function帶進來的參數)
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }
// ==========================================================================================================================================================
// 取多筆資料
    public function all(...$arg){ // $arg=放入欲查詢內容
        $sql="SELECT * FROM $this->table "; // 查詢全部, 資料來自table
        
        // $arg[0]代表第一個參數
        if(isset($arg[0])){ // 有無"指定的查詢內容"參數, 若有將該參數處理
            if(is_array($arg[0])){ // 若該參數為陣列時
                foreach($arg[0] as $key => $value){ // 對該"參數陣列"處理, 拆成key value
                    $tmp[]="`$key`='$value'"; // 將$key+$value 串成字串: "`key1`='value1' , `key2`='value2'..等" 放入陣列$tmp[]
                }
                
                $sql.=" WHERE ".join(" AND ", $tmp); // $sql=查全部 符合陣列$tmp[]的內容: "SELECT * FROM $table WHERE `key1`='value1' AND `key2`='value2'..等"
            }else{ // 若非字串
                $sql.=$arg[0]; // $sql=查全部 符合該$arg[0]字串 的內容 // 少WHERE???
                
            }
        }
        // $arg[1]代表第二個參數
        if(isset($arg[1])){ // 上方function(用...$arg)代表可有複數參數, 需判斷若為複數參數..
            $sql.=$arg[1]; // 執行 // $sql=查全部 符合該$arg[0]字串 的內容 // 少WHERE???
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); // 執行SQL句 : 查詢內容
    }

// ==========================================================================================================================================================
// 只取一筆資料
    public function find($id){ 
        $sql="SELECT * FROM $this->table "; 
        
            if(is_array($id)){ 
                foreach($id as $key => $value){ 
                    $tmp[]="`$key`='$value'"; 
                }
                
                $sql.=" WHERE ".join(" AND ", $tmp); 
            }else{ 
                $sql.= " WHERE `id` = '$id' "; 
                
            }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC); // 只取一筆使用fetch
    }

// ==========================================================================================================================================================
// 刪除
    public function del($id){ 
        $sql="DELETE FROM $this->table "; 

            if(is_array($id)){ 
                foreach($id as $key => $value){ 
                    $tmp[]="`$key`='$value'"; 
                }

                $sql.=" WHERE ".join(" AND ", $tmp); 
            }else{ 
                $sql.= " WHERE `id` = '$id' "; 

            }

        return $this->pdo->exec($sql); // 不須回傳資料, 只需執行, 改用exec()
    }

// ==========================================================================================================================================================
// 更新或新增
    public function save($array){
        if(isset($array['id'])){ // 如果有id必為已存在資料內的資料, 執行"更新"之動作
            foreach($array as $key => $value){ // 從資料庫獲取的一整筆資料, 拆成$key $value
                if($key!='id'){ // 資料庫取出的一整筆資料, 欄位不只有id, 也會有其他欄位, 將其他欄位組合成 `欄`='值', 供後續執行SQL語句
                    $tmp[]="`$key`='$value'";
                }
            }
            /* 上方foreach把$array提供的資料組成$tmp[], 陣列$tmp[]裡會是以逗號區隔的多個字串內容,
               使用join(以逗號做為區隔)將$tmp[]內的內容完整排列出多個字串內容 */
            $sql="UPDATE $this->table SET ".join(',',$tmp)." WHERE `id`='{$array['id']}'"; // UPDATE table SET `欄1`='值1',`欄2`='值2' WHERE `id`='參數給的id'
        }else{ // 若無id代表未存入資料庫, 執行"新增"之動作

            // array_keys()==僅把陣列裡的所有key, 挑出來組成一個陣列
            $sql="INSERT INTO $this->table (`".join("`,`",array_keys($array))."`) VALUES('".join("','",$array)."')";
            // $範例="INSERT INTO TABLE (`欄1`,`欄2`) VALUES('值1','值2')";
        
        }
        return $this->pdo->exec($sql); // 不須回傳資料, 只需執行, 改用exec()
    }

// ==========================================================================================================================================================
// 計算
    public function nath($math,$col,...$arg){ 
        $sql="SELECT $math($col) FROM $this->table "; // 查詢計算結果
        
        if(isset($arg[0])){ 
            if(is_array($arg[0])){ 
                foreach($arg[0] as $key => $value){ 
                    $tmp[]="`$key`='$value'"; 
                }
                
                $sql.=" WHERE ".join(" AND ", $tmp); 
            }else{ 
                $sql.=$arg[0]; 
                
            }
        }
        if(isset($arg[1])){ 
            $sql.=$arg[1]; 
        }
        return $this->pdo->query($sql)->fetchColumn(); // 計算結果使用fetchColumn()
    }

// ==========================================================================================================================================================
// 查詢SQL句回傳的內容
    public function q($sql){
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

// ==========================================================================================================================================================
}
class Str{
    public $header;
    public $imgHead;
    public $textHead;
    public $updateImg;
    public $acc;
    public $pw;
    public $mainText;
    public $mainHref;
    public $subText;
    public $subHref;
    public $addBtn;
    public $addModalHeader;
    public $addModalCol;
    public $table;

    public function __construct($table)
    {
        $this->table=$table;
        switch($table){
            case 'title':
                $this->header="網站標題管理";
                $this->imgHead="網站標題";
                $this->textHead="替代文字";
                $this->updateImg="更新圖片";
                $this->addBtn="新增網站標題圖片";
                $this->addModalHeader="新增網站標題圖片";
                $this->addModalCol=["標題區圖片","標題區替代文字"];
            break;
            case 'ad':
                $this->header="動態文字廣告管理";
                $this->textHead="動態廣告文字";
                $this->addBtn="新增動態文字廣告";
                $this->addModalHeader="新增動態文字廣告";
                $this->addModalCol=["動態文字廣告"];
            break;
            case 'image':
                $this->header="校園映像資料管理";
                $this->imgHead="校園映像資料圖片";
                $this->updateImg="更換圖片";
                $this->addBtn="新增校園映像圖片";
                $this->addModalHeader="新增校園映像圖片";
                $this->addModalCol=["校園映像圖片"];
            break;
            case 'mvim':
                $this->header="";
            break;
            case 'total':
                $this->header="";
            break;
            case 'bottom':
                $this->header="";
            break;
            case 'news':
                $this->header="";
            break;
            case 'admin':
                $this->header="";
            break;
            case 'menu':
                $this->header="";
            break;

        }
    }
}
function to($url){
    header("location:".$url);
}
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


// $Bottom=new DB('bottom'); // 執行上發建立的class DB並帶入'bottom'參數, 供$table使用
// print_r($Bottom->all()); // 印出 : 使用new DB帶'bottom'參數, 執行class DB裡的all()


/* query() = 執行SQL語句, 並回傳獲取的資料 (查詢等供後續使用)
   exec() = 僅執行SQL, 不回傳資料 (刪除等不供後續使用)
*/

$Bottom=new DB('bottom');
$Title=new DB('title');
$Ad=new DB('ad');
$Image=new DB('image');
$Str=new Str($do);
?>



