<?php
	class Process {
		
		protected $post;
		
		function __construct(){
			
			$firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '' ;
			$lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '' ;
			$email = isset($_POST['email']) ? $_POST['email'] : '' ;
			$isPost = isset($_POST['is_post']) ? $_POST['is_post'] : '' ;
			
			$this->post = array(
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'is_post' => $isPost
			);
		}
		function init(){
			$args = $this->post;
			if($args['is_post'] == 1){	
				$to      = 'jcruz@optimizex.com,jaguilar@optimizex.com';
				$subject = 'AMP FORM';
				$message = "
					<p>Name: ".$args['first_name']."&nbsp;".$args['last_name']."</p>
					<p>".$args['email']."</p>
					";
				$headers = 'From: amp@primeview.com' . "\r\n" .
					'MIME-Version: 1.0' . "\r\n" .
					'Content-Type: text/html;charset=UTF-8' . "\r\n" .
					'Reply-To: '.$args["email"].'' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				$result = mail($to, $subject, $message, $headers);		
				if($result){
					return $this->response();
				}
				else{
					die('PHP ERROR');
				}
			}else{
				die('Post only');
			}
		}
		
		function response(){
			
			$args = $this->post;
			
			$this->getHeader();
			
			$output = [
				'first_name' => $args['first_name'],
				'last_name' => $args['last_name'],
				'email' => $args['email']
			];
			echo json_encode($output);
			die();
		}
		
		function getHeader(){
			header("Content-type: application/json"); 
			header("Access-Control-Allow-Credentials: true");
			header("Access-Control-Allow-Origin: *.ampproject.org");
			header("AMP-Access-Control-Allow-Source-Origin: http://marvin.primeview.com");
			header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");			
		}
	}
	$process = new Process();
	$process->init();
?> 
