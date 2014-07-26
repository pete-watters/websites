 window.validate = function(name, email, subject, message){
                var errorCount = 0;
                var errorString ="";

                var name = name;
                var email = email;
                var subject = subject;
                var message = message;


                function validateEmail(email) { 
                        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        return re.test(email);
                    }
                function validateAlphanumeric(field){
                        var re = /^[a-zA-Z\-0-9 '"?:;.,@#\r\n]+$/i;
                         return re.test(field);
                    }

                var testEmail = validateEmail(email);
                var testName = validateAlphanumeric(name);
                var testSubject = validateAlphanumeric(subject);
                var testMessage = validateAlphanumeric(message);

                if(!(name)){
                    errorCount++;
                    errorString = errorString+"<li> Name is required.</li>";                    
                }else if(!(name.length >3)){
                    errorCount++;
                    errorString = errorString+"<li> Name minimum length 3 charachters.</li>";                    
                }

                if(!(email)){
                    errorCount++;
                    errorString = errorString+" <li>Email address is required.</li>";                    
                }else if(!(email.length >0)){
                    errorCount++;
                    errorString = errorString+" <li>A valid Email address is required.</li>";                    
                }
                if(!(testEmail)){
                    errorCount++;
                    errorString = errorString+"<li>A valid Email address is required.</li>";
                }

                if(!(subject)){
                    errorCount++;
                    errorString = errorString+"<li>Subject is required.</li>";
                }else if(!(subject.length > 10)){
                    errorCount++;
                    errorString = errorString+"<li>Subject minimum length 10 charachters.</li>";
                }

                if(!(message)){
                    errorCount++;
                    errorString = errorString+"<li>Message is required.</li>";
                }else if(!(message.length > 20) ){
                    errorCount++;
                    errorString = errorString+"<li>Message minimum length 20 charachters.</li>";
                }             

                if(!(testName) || !(testSubject) || !(testMessage)){
                    errorCount++;
                    errorString = errorString+"<li>Alphanumeric charachters only.</li>";
                }
                return[errorCount,errorString];
            }