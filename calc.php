<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
<style>

  .calculator td {
    width: 250px;
    height: 100px;
    border: 1px solid black;
    text-align: center;
}
  .total {
    width: 100%;
    text-align: right;
} 

  h1 {
  box-sizing: border-box;
  padding-right: 10px;
}
  input {
  width: 100%;
  height: 100%;
}



</style>
</head>
<body>
<?php 
session_start();
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function clearNums() {
    session_unset();
}
 function addNums() {
    $_SESSION["total"] = $_SESSION["total"] + $_SESSION["num1"]; 

 }

function subNums() {
    if($_SESSION["total"] > 0) {
      $_SESSION["total"] = $_SESSION["total"] - $_SESSION["num1"];
    } else {
      $_SESSION["total"] = $_SESSION["num1"];
    }
}

function multNums() {
    if($_SESSION["total"] > 0 && $_SESSION["num1"] > 0) {
      $_SESSION["total"] = $_SESSION["total"] * $_SESSION["num1"];
    } elseif($_SESSION["num1"] > 0) {
      $_SESSION["total"] = $_SESSION["num1"];
    }
}

function divideNums() {
    if($_SESSION["total"] > 0 && $_SESSION["num1"] > 0) {
      $_SESSION["total"] = $_SESSION["total"] / $_SESSION["num1"];
    } elseif($_SESSION["num1"] > 0) {
      $_SESSION["total"] = $_SESSION["num1"];
    }
}

function opPicker($op) {
  switch ($op) {
    case "+":
      addNums();
      break;
    case "-":
      subNums();
      break;
    case "/":
      divideNums();
      break;
    case "*":
      multNums();
      break;
  }
}

if(isset($_GET["clear"])) {
  clearNums();
}

if(isset($_GET["num"])) {
    $number1 = $_GET["num"];
    $total = $_GET["total"];
    $total .= $number1;
    $_SESSION["num1"] = $total;
}

if(isset($_GET["sub"])) {
    if($_SESSION["symbol"] == null) {
      opPicker("-");
    } else {
      opPicker($_SESSION["symbol"]);
    }
    $_SESSION["symbol"] = "-";
    $symbol = "-";
}


if(isset($_GET["mult"])) {
    if($_SESSION["symbol"] == null) {
      opPicker("*");
    } else {
      opPicker($_SESSION["symbol"]);
    }
    $_SESSION["symbol"] = "*";
    $symbol = "*";
}

if(isset($_GET["plus"])) {
    if($_SESSION["symbol"] == null) {
      opPicker("+");
    } else {
      opPicker($_SESSION["symbol"]);
    }
    $_SESSION["symbol"] = "+";
    $symbol = "+";
}

if(isset($_GET["divide"])) {
    if($_SESSION["symbol"] == null) {
      opPicker("/");
    } else {
      opPicker($_SESSION["symbol"]);
    }
    $_SESSION["symbol"] = "/";
    $symbol = "/";
}

if(isset($_GET["equals"])) {
  switch($_SESSION["symbol"]) {
    case "-":
      $total = $_SESSION["total"] - $_SESSION["num1"];
      $_SESSION["total"] = $total;
      $_SESSION["num1"] = 0;
      break;
    case "+":
      $total = $_SESSION["num1"] + $_SESSION["total"];
      $_SESSION["total"] = $total;
      $_SESSION["num1"] = 0;
      break;
    case "*":
      $total = $_SESSION["total"] * $_SESSION["num1"];
      $_SESSION["total"] = $total;
      $_SESSION["num1"] = 0;
      break;
    case "/":
      $total = $_SESSION["total"] / $_SESSION["num1"];
      $_SESSION["total"] = $total;
      $_SESSION["num1"] = 0;
      break;
  }
}
?>



<form action="calc.php" method="get">
<table class="calculator"> 
  <tr>
  <td colspan="3">
<h1 class="total"><?php echo $total; ?></h1>
</td>
    <td><input type="submit" name="clear" value="C"></td>
  </tr>
	<tr>
		<td><input type="submit" name="num" value="1"></td>
    <td><input type="submit" name="num" value="2"></td>
    <td><input type="submit" name="num" value="3"></td>
    <td><input type="submit" name="divide" value="/"></td>
	</tr>
  <tr>
		<td><input type="submit" name="num" value="4"></td>
    <td><input type="submit" name="num" value="5"></td>
    <td><input type="submit" name="num" value="6"></td>
    <td><input type="submit" name="mult" value="*"></td>
	</tr>
  <tr>
		<td><input type="submit" name="num" value="7"></td>
    <td><input type="submit" name="num" value="8"></td>
    <td><input type="submit" name="num" value="9"></td>
    <td><input type="submit" name="sub" value="-"></td>
	</tr>
  <tr>
  <td></td>
    <td><input type="submit" name="num" value="0"></td>
    <td><input type="submit" name="equals" value="="></td>
    <td><input type="submit" name="plus" value="+"></td>
	</tr>
</table>
<input type="hidden" name="total" value="<?php echo $total; ?>">
</form>


</body>
</html>
