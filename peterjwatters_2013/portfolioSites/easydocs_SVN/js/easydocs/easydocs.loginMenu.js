$.fn.loginMenu = function(loginMenu_data) {
 
        var source =  '<div id="loggedin">{{title}}'
        			 +'<span id="username">{{name}}</span><div class="middleline"></div></div>' 
					 + '<a href="" title="Logout" class="logout">Logout <img src="images/logout.png" alt="Logout"></a>';

        var template = Handlebars.compile(source); 

        var data = loginMenu_data ; 

        var return_html = template(data);
        
        return this.html(return_html);

};