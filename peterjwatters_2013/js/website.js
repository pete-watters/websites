var app = angular.module('website', []).
            config(function($routeProvider) {
                $routeProvider.
                    when('/projects', {template:'partials/projects.html', controller:ProjectCtrl}).
                    when('/portfolio', {template:'partials/portfolio.html', controller:PortfolioCtrl   }).
                    when('/blog', {template:'partials/blog.html', controller:BlogCtrl   }).
                    when('/contact', {template:'partials/contact.html', controller:ContactCtrl   }).
                    when('/sitemap', {template:'partials/sitemap.html', controller:SitemapCtrl   }).
                    when('/news_10th_october', {template:'partials/news_10th_october.html', controller:NewsCtrl   }).            
                    when('/news_15th_september', {template:'partials/news_15th_september.html', controller:NewsCtrl   }).            
                    when('/news_09th_june', {template:'partials/news_09th_june.html', controller:NewsCtrl   }).            
                    when('/integra', {template:'partials/portfolio/integra.html', controller:PortfolioContentCtrl   }).        
                    when('/fitnessperformancesystems', {template:'partials/portfolio/fitnessperformancesystems.html', controller:PortfolioContentCtrl   }).        
                    when('/ocuco', {template:'partials/portfolio/ocuco.html', controller:PortfolioContentCtrl   }).        
                    when('/peterjwatters_old', {template:'partials/portfolio/peterjwatters_old.html', controller:PortfolioContentCtrl   }).        
                    when('/student_perform', {template:'partials/portfolio/student_perform.html', controller:PortfolioContentCtrl   }).        
                    when('/tnf_dashboard', {template:'partials/portfolio/tnf_dashboard.html', controller:PortfolioContentCtrl   }).        
                    when('/tnf_inventory', {template:'partials/portfolio/tnf_inventory.html', controller:PortfolioContentCtrl   }).        
                    when('/pel', {template:'partials/portfolio/finalYearProject_PEL.html', controller:PortfolioContentCtrl   }).
                    when('/home', {template:'partials/home.html', controller:HomeCtrl   }).
                    otherwise({redirectTo:'/home'});
            });

function ProjectCtrl($scope) {
    $scope.title = 'Projects';
    $scope.body = 'This is the projects page body';
    $(".message").hide();
    $("#gallery").hide();
}

/* main portfolio page*/
function PortfolioCtrl($scope) {
    $scope.title = 'Portfolio';
    $scope.body = 'This is the portfolio page body';
    $(".message").hide();
    $("#gallery").show();

    /* function to make roundabout images change URL to load correct partial */
    $('#myRoundabout img').click(function(){
        // Change the URL to load correct information
        window.location.hash = "#/" + $(this).attr("name");
      });
}
/* portfolio content pages loaded*/
function PortfolioContentCtrl($scope) {
    $scope.title = 'Portfolio';
    $scope.body = 'This is the portfolio page body';
    $(".message").hide();
    $("#gallery").show();

    /* function to make roundabout images change URL to load correct partial */
    $('#myRoundabout img').click(function(){
        // Change the URL to load correct information
        window.location.hash = "#/" + $(this).attr("name");
      });
    // add button to return to main portfolio after title of each sub page
  $("section article h2").append('<a href="#/portfolio" role="button" class="btn btn-info portfolio-back-btn"> <i class="icon-home icon-white"></i> Portfolio Home</a>');
  $("section article h2").append('<a href="#webPortfolioModal" role="button" class="btn btn-warning portfolio-content-btn" data-toggle="modal"><i class="icon-fullscreen icon-white"></i> Browse Web Portfolio</a>');


    

}

function ContactCtrl($scope) {
    $scope.title = 'Contact';
    $scope.body = 'This is the contact page body';
    $(".message").hide();
    $("#gallery").hide();

          $("#contact .button").click(function() {     
            var name = $("#form_name").val();     
            var email = $("#form_email").val();     
            var text = $("#msg_text").val();     
            var dataString = 'name='+ name + '&email=' + email + '&text=' + text;      
            $.ajax({     
              type: "POST",     
              url: "email.php",
              data: dataString,     
              success: function(){       
                $('.success').fadeIn(1000);     
                                  }     
                                });      
              return false;   
         }); 
}
function BlogCtrl($scope) {
    $scope.title = 'Blog';
    $scope.body = 'This is the blog page body';
    $(".message").hide();
    $("#gallery").hide();
}
function SitemapCtrl($scope) {
    $scope.title = 'Sitemap';
    $scope.body = 'This is the sitemap page body';
    $(".message").hide();
    $("#gallery").hide();
}
function NewsCtrl($scope) {
    $scope.title = 'News';
    $scope.body = 'This is the news body';
    $(".message").hide();
    $("#gallery").hide();
}

function HomeCtrl($scope) {
    $scope.title = 'Home Page';
    $scope.body = 'This is the about home body';
    $(".message").hide();
    $("#gallery").hide();
}

function EmailCtrl($scope, $http) {
    $scope.url = 'email.php'; 

    // The function that will be executed on button click (ng-click="search()")
    $scope.submit = function() {
        
        var checkFields = validate($scope.name, $scope.email, $scope.subject, $scope.message );     

        if(parseInt(checkFields[0]) > 0){
            $("#contact-welcome-text").hide();
            // error count exceeds 1 so show error div
            var errorString = '<ul >'+checkFields[1]+'</ul>';          
            $('.warning.message').show('puff', 'fast').html('<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'+
                                            '<h3>There are ' + checkFields[0] + ' errors.</h3>'  + errorString); 
        }else{

        /*
        *   Show Loader
        */
         $(function() {
              var $topLoader = $("#topLoader").percentageLoader({width: 256, height: 256, controllable : true, progress : 0.5, onProgressUpdate : function(val) {
                  $topLoader.setValue(Math.round(val * 100.0));
                }});

              var topLoaderRunning = false;

                /*START run to show loader */
                if (topLoaderRunning) {
                  return;
                }
                topLoaderRunning = true;
                $topLoader.setProgress(0);
                $topLoader.setValue('0%');
                var kb = 0;
                var totalKb = 100;
                
                var animateFunc = function() {
                  kb += 1;
                  $topLoader.setProgress(kb / totalKb);
                  $topLoader.setValue(kb.toString() + '%');
                  
                  if (kb < totalKb) {
                    setTimeout(animateFunc, 25);
                  } else {
                    topLoaderRunning = false;
                  }
                }                
                setTimeout(animateFunc, 25);                                
                /*END run to show loader */              
            });      


            $("#formFieldError").hide();
        // Create the http post request, the data holds the keywords
        $http.post($scope.url, { 
                                "name" : $scope.name,
                                "email" : $scope.email,
                                "subject" : $scope.subject,
                                "message" : $scope.message 
                                    }).
        success(function(data, status) {
            $("#contact-form").hide();        

        if( (data == "Request failed") || (data == "Invalid Email") || (data == "Invalid Body")|| (data == "Invalid Subject") ||  (data == "Invalid Name"))
        {

         $(".warning.message").hide("explode","fast");
         $("#email-error").show("blind","fast");
         $('.error.message').show("puff").html('<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'+
                                               '<h3>There is an error:</h3><ul><span id="server-side-error-span"></span>' +data + '</ul>'); 

        $(".server-side-error").show();
        $("#server-side-error-span").append($(".server-side-error"));
    
        }else{
         $("#email-error").hide("explode","fast");
         $(".error.message").hide("explode","fast");
         $(".warning.message").hide("explode","fast");

         $("#topLoader").show("fast").delay(2000).hide("explode", function(){
             $("#email-confirmation").show("puff");
             $('.success.message').append($("#email-confirmation")).show("slide");
             // go to home after 5 seconds
            setTimeout(function(){
                                    $('.success.message').hide("explode");
                                    window.location.href="#/home"} , 5000);   
    
         });

            $scope.status = status;
            $scope.data = data;
            $scope.result = data ;  
        }         

        })
        .
        error(function(data, status) {
            $scope.data = data || "Request failed";
            $scope.status = status;         
            $("#contact-form").hide();        
            $("#email-error").show();
        });

    }

    };

     $scope.refreshForm = function() {       
            $("#email-error").hide();
            $("#contact-form").show(); 
     };
}
