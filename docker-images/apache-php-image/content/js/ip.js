$(function(){
     console.log("loading ip");

     function getIp(){
		$.ajax({
			url : "/api/getip/",
			success : function(result){
				$("#ipDynamic").text("Adresse serveur dynamic: " + result);
			}
		});
     };
	 
     getIp();
     setInterval(getIp, 2000);
});