<?php
/* print_r($_SERVER); */
class api{
	
	function __construct(){
		$conn = '';
		//echo "hlo";
		$this->conn = mysqli_connect("localhost","root","","rest");
		$this->perform_function($this->request_method());		
	}

	function request_method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
	
	function perform_function($request_method){
		switch($request_method){
			CASE "GET":
				$this->fetch_users();
				break;
			CASE "POST":
				$this->create_new_user();
				break;
			CASE "PATCH":
				$this->update_user();
				break;
			CASE "DELETE":
				$this->delete_user();
				break;
			default:
                echo "No method";
                break;
		}
	}
	
	function json($data){
        if(is_array($data)){
            return json_encode($data);
        }
    }
	
	function fetch_users(){
		$query = "select * from users";
		//if(isset($_GET['username']))
		if(isset($_SERVER['PATH_INFO']))
		{
			//$username = $_GET['username'];
			$username = str_replace("/","",$_SERVER['PATH_INFO']);
			$query.= " where username = '$username'";
		}
		$query = mysqli_query($this->conn,$query);
		$result = array();
		while($row = mysqli_fetch_assoc($query)){
			$result[] = $row;;
		}

		$encode = $this->json($result);
		print_r($encode);		
		//print_r(json_decode($encode)[0]->username);
	}
	
	function delete_user(){
		//if(isset($_GET['username']))
		if(isset($_SERVER['PATH_INFO']))
		{
			//$username = $_GET['username'];
			$username = str_replace("/","",$_SERVER['PATH_INFO']);
			$query = " delete from users where username = '$username'";
		}
		$query = mysqli_query($this->conn,$query);
		
		if($query){
			$result = array("success"=>1);
		} else{
			$result = array("success"=>0);
		}
		$encode = $this->json($result);
		print_r($encode);
	}
	
	function create_new_user(){
		
		$username = $_POST['username'];
		
		$query = "insert into users(username)values('$username')";
		$query = mysqli_query($this->conn,$query);
		
		if($query){
			$result = array("success"=>1);
		} else{
			$result = array("success"=>0);
		}
		$encode = $this->json($result);
		print_r($encode);
	}
	
	function update_user(){	
		//if(isset($_POST['name']) && isset($_GET['user'])){
			//echo "hi";
			//$user = $_GET['user'];
			//print_r($_REQUEST);
			
			$user = str_replace("/","",$_SERVER['PATH_INFO']);
			
			parse_str(file_get_contents("php://input"), $_PATCH);
			
			$name = $_PATCH['name'];

			/* foreach ($_PUT as $key => $value)
			{
				//print_r($_PUT);
				print_r($value['name']);
			} */

			//die;
			$query = "UPDATE users SET username = '$name' WHERE username = '$user' ";
			
			$query = mysqli_query($this->conn,$query);
		
			if($query){
				$result = array("success"=>1);
			} else{
				$result = array("success"=>0);
			}
			$encode = $this->json($result);
			print_r($encode);
		//}
	}
	
}

new api();

?>