<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="http://at.alicdn.com/t/font_259571_nrqiid881b4holxr.css">
		<link rel="stylesheet" href="css/style.css" />
	</head>

	<body>
		<div class="layout layout-login">
			<div class="mui-content">
				<div class="login-page">
					<div class="logo-img">
						<i class="logo-svg"></i>
					</div>
					<div class="login-form">
						<div class="login-tel clearfix">
							<input id="phoneNumber" type="text" placeholder="Enter phone number" />
							<button id="getCode" type="button" class="mui-btn">Send Code</button>
							<!-- <input id="getCode" class="mui-btn" type="button" value="Send Code"> -->
						</div>
						<div class="login-code">
							<input id="code" type="text" placeholder="Enter verification code " />
						</div>
						<div class="login-btn">
							<button type="button" id="loginBtn" class="mui-btn">LOG IN</button>
						</div>
					</div>

					<div class="weixin-login">
						<div class="title">
							<span>Wechat Login</span>
							<div class="line"></div>
						</div>
						<div class="weixin-login-btn">
							<a href="http://page.thatsmags.com/WebAccess/get-weixin-code.html?appid=wx06e97f4ed4ac07e3&scope=snsapi_userinfo&state=STATE&redirect_uri=http%3A%2F%2Fapi.mall.thatsmags.com%2FUser%2FAccount%2FthirdLogin">
								<i id="wechatLogin" class="iconfont icon-weixin1"></i>
							</a>
								
							
							
						</div>
					</div>
				</div> 
			</div>
		</div>
		<script src="js/mui.min.js"></script>
		<script src="js/h.min.js"></script>
		<script type="text/javascript">

			
			(function($) {
				mui.init();
				var loginBtn = document.getElementById('loginBtn');
				var getCode = document.getElementById('getCode');
				var countdown=60;
				getCode.addEventListener('tap',function(){
					var phoneNumber = document.getElementById('phoneNumber').value;
					var code = document.getElementById('code').value;
					if (!phoneNumber) {
						mui.toast('Please enter your number!');
						return;
					} else if (!(/^1[34578]\d{9}$/.test(phoneNumber))) {
						mui.toast("Please enter a 11-digit valid number!");
						return;
					}	
					settime(this);

				})
				loginBtn.addEventListener('tap',function(){
					var phoneNumber = document.getElementById('phoneNumber').value;
					var code = document.getElementById('code').value;
					if (!phoneNumber) {
						mui.toast('Please enter your number!');
						return;
					} else if (!(/^1[34578]\d{9}$/.test(phoneNumber))) {
						mui.toast("Please enter a 11-digit valid number!");
						return;
					}
					if (!code) {
						mui.toast('Please enter the verification code!');
					}	

				})

				// h('#wechatLogin').tap(function(){
				// 	mui.ajax('http://api.mall.thatsmags.com/User/Account/thirdLogin',{
				// 	    data: {
				//         	code: "123123"
				//         },
				// 		dataType:'json',//服务器返回json格式数据
				// 		type:'get',//HTTP请求类型
				// 		timeout:10000,//超时时间设置为10秒；
				// 		// headers:{'Content-Type':'application/json'},	              
				// 		success:function(data){
				// 			//服务器返回响应，根据响应结果，分析是否登录成功；
				// 			// ...
				// 			console.log(data);
				// 		},
				// 		error:function(xhr,type,errorThrown){
				// 			//异常处理；
				// 			console.log(123);
				// 		}
				// 	});
		
				// });

				function settime(obj) {   
					if (countdown == 0) {   
					    obj.removeAttribute("disabled");  
					    obj.style.backgroundColor = "#fc4002";  
					    obj.style.color = "#fff"; 
					    obj.innerText="Send code";   
					    countdown = 60;   
					    return;  
					} else {   
					    obj.setAttribute("disabled", true);
					    obj.style.backgroundColor = "#6A6A6A"; 
					    obj.style.color = "#fff";   
					    obj.innerText = countdown+ "s";   
					    countdown--;   
					}   
					setTimeout(function() {   
					    settime(obj);
					},1000);
				} 

				var userCode = getQueryString("code") || null;
				if (userCode) {
					login ();
				}
				function login () {
					mui.ajax('http://api.mall.thatsmags.com/User/Account/thirdLogin',{
					    data: {
				        	code: userCode
				        },
						dataType:'json',//服务器返回json格式数据
						type:'get',//HTTP请求类型
						timeout:10000,//超时时间设置为10秒；
						// headers:{'Content-Type':'application/json'},	              
						success:function(data){
							//服务器返回响应，根据响应结果，分析是否登录成功；
							// ...
							console.log(data);
						},
						error:function(xhr,type,errorThrown){
							//异常处理；
							console.log(123);
						}
					});
				}

				function getQueryString(name) {
					var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
					var r = window.location.search.substr(1).match(reg);
				if (r != null) {
					return unescape(r[2]);
				}
					return null;
				}
			})(mui);

			
		</script>
	</body>

</html>