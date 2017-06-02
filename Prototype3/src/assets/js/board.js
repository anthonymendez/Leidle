function boardFunctions(){
/*
    Leidle Prototype 3 Board Javascript Functions
*/

    //Keeps a track of what page in the Create a Picket system we're on.
    var submitPage = 0;
    //Checks if we're on the first page of "Create a Picket" system
    var pickingimages = true;
    //Makes sure that we don't continuously append new input or textarea DOMs
    var appended = false;
    //Keeps track of the grid boxes that hold image links
    var selectedimages = [false,false,false,false,false,false,false,false,false];
    //Keeps the values of each respect input or textareas
    var textboxes = ['','','','','','','','',''];
    //Hiding box so users can't go back a page.
    $("#back").hide();
    
    // var response = grecaptcha.getResponse();
    // if(response != 0){
    //     $("#submitpicket").show();
    // }else{
    //     $("#submitpicket").hide();
    // }

    //Reveals the Create a Picket Form
    $(".expandcreate").click(function (){
        $(".create").slideToggle("fast","swing",function(){
            $(".create").toggleClass("createtoggle");
        });
    });
    //
    $("#signup-menu").click(function(){
        $(".signup-menu").slideToggle(function(){
            $(".signup-menu").toggleClass("flex");
        });
    });
    $("#signup-menu-exit").click(function(){
        $(".signup-menu").slideToggle(function(){
            $(".signup-menu").toggleClass("flex");
        });
    });
    $("#login-menu").click(function(){
        $(".login-menu").slideToggle(function(){
            $(".login-menu").toggleClass("flex");
        });
    });
    $("#login-menu-exit").click(function(){
        $(".login-menu").slideToggle(function(){
            $(".login-menu").toggleClass("flex");
        });
    });

    //Selects the squares that will have an image, applies the pickedsquares class for our #next click function
    $(".square").click(function(){
        if(pickingimages)
            $(this).children(":first").toggleClass("pickedsquares");
    });

    //Goes through each page of the "Create a Picket" system with different functions for each appropriate page.
    $("#next").click(function(){
        //If we're on the first page...
        if(submitPage == 0){
            //Save all the boolean (if this square is supposed to have an image) to a 9 element array.
            var hasPicked = [
                $("#1").children(":first")[0].classList.contains("pickedsquares"),
                $("#2").children(":first")[0].classList.contains("pickedsquares"),
                $("#3").children(":first")[0].classList.contains("pickedsquares"),
                $("#4").children(":first")[0].classList.contains("pickedsquares"),
                $("#5").children(":first")[0].classList.contains("pickedsquares"),
                $("#6").children(":first")[0].classList.contains("pickedsquares"),
                $("#7").children(":first")[0].classList.contains("pickedsquares"),
                $("#8").children(":first")[0].classList.contains("pickedsquares"),
                $("#9").children(":first")[0].classList.contains("pickedsquares")
            ];

            //Go through each boolean to check for any changes.
            //If there were, appended becomes true and we will have to recreate all the inputs or textareas.
            for(var i = 0; i < 9; i++){
                if(selectedimages[i] != hasPicked[i]){
                    appended = false;
                    break;
                }
            }

            selectedimages = hasPicked;

            //Hide all of the Page 1 elements
            $("#1 div").hide();
            $("#2 div").hide();
            $("#3 div").hide();
            $("#4 div").hide();
            $("#5 div").hide();
            $("#6 div").hide();
            $("#7 div").hide();
            $("#8 div").hide();
            $("#9 div").hide();

            //If we have not appended inputs, textareas, or need to reappend...
            if(!appended){
                //Create a 9 element String array to store the types of inputs to append.
                var input = [
                    '','','','','','','','',''
                ];
                //Check each boolean of the array. If it's true, then we'll place an input DOM that users will submit their image links
                //If it's false, then we'll just place a regular textarea DOM.
                for(var i = 0; i <= 8; i++){
                    if(selectedimages[i]){
                        input[i] = "<input type = \"text\" placeholder = \"Insert Image URL here!\" />";
                    }else{
                        input[i] = "<textarea placeholder = \"Text here!...\"></textarea>";
                    }
                }
                //Delete all the input/textarea to make sure there aren't any duplicates
                $("#1 input").remove();
                $("#1 textarea").remove();
                $("#2 input").remove();
                $("#2 textarea").remove();
                $("#3 input").remove();
                $("#3 textarea").remove();
                $("#4 input").remove();
                $("#4 textarea").remove();
                $("#5 input").remove();
                $("#5 textarea").remove();
                $("#6 input").remove();
                $("#6 textarea").remove();
                $("#7 input").remove();
                $("#7 textarea").remove();
                $("#8 input").remove();
                $("#8 textarea").remove();
                $("#9 input").remove();
                $("#9 textarea").remove();

                //Appends all the DOM as a child to each square
                $("#1").append(input[0]);
                $("#2").append(input[1]);
                $("#3").append(input[2]);
                $("#4").append(input[3]);
                $("#5").append(input[4]);
                $("#6").append(input[5]);
                $("#7").append(input[6]);
                $("#8").append(input[7]);
                $("#9").append(input[8]);

                appended = true;
            //Else, we just show the appropriate input and textareas.
            }else{
                if(selectedimages[0]){
                    $("#1 input").show();
                }else{
                    $("#1 textarea").show();
                }
        
                if(selectedimages[1]){
                    $("#2 input").show();
                }else{
                    $("#2 textarea").show();
                }

                if(selectedimages[2]){
                    $("#3 input").show();
                }else{
                    $("#3 textarea").show();
                }

                if(selectedimages[3]){
                    $("#4 input").show();
                }else{
                    $("#4 textarea").show();
                }

                if(selectedimages[4]){
                    $("#5 input").show();
                }else{
                    $("#5 textarea").show();
                }

                if(selectedimages[5]){
                    $("#6 input").show();
                }else{
                    $("#6 textarea").show();
                }

                if(selectedimages[6]){
                    $("#7 input").show();
                }else{
                    $("#7 textarea").show();
                }

                if(selectedimages[7]){
                    $("#8 input").show();
                }else{
                    $("#8 textarea").show();
                }

                if(selectedimages[8]){
                    $("#9 input").show();
                }else{
                    $("#9 textarea").show();
                }
            }
            //Show the back button
            $("#back").show();
            //Increment page counter
            submitPage++;
            //We are not picking which box will have images
            pickingimages = false;
        }
        else if(submitPage == 1){

            if(selectedimages[0]){
                textboxes[0] = $("#1 input").value;
            }else{
                textboxes[0] = $("#1 textarea").value;
            }
            
            if(selectedimages[1]){
                textboxes[1] = $("#2 input").value;
            }else{
                textboxes[1] = $("#2 textarea").value;
            }

            if(selectedimages[2]){
                textboxes[2] = $("#3 input").value;
            }else{
                textboxes[2] = $("#3 textarea").value;
            }

            if(selectedimages[3]){
                textboxes[3] = $("#4 input").value;
            }else{
                textboxes[3] = $("#4 textarea").value;
            }

            if(selectedimages[4]){
                textboxes[4] = $("#5 input").value;
            }else{
                textboxes[4] = $("#5 textarea").value;
            }

            if(selectedimages[5]){
                textboxes[5] = $("#6 input").value;
            }else{
                textboxes[5] = $("#6 textarea").value;
            }

            if(selectedimages[6]){
                textboxes[6] = $("#7 input").value;
            }else{
                textboxes[6] = $("#7 textarea").value;
            }

            if(selectedimages[7]){
                textboxes[7] = $("#8 input").value;
            }else{
                textboxes[7] = $("#8 textarea").value;
            }

            if(selectedimages[8]){
                textboxes[8] = $("#9 input").value;
            }else{
                textboxes[8] = $("#9 textarea").value;
            }

            $(".gridrow input").prop("readonly",true);
            $(".gridrow textarea").prop("readonly",true);
            $(".gridrow input").prop("disabled",true);
            $(".gridrow textarea").prop("disabled",true);
            $("#next").fadeOut("fast");
            $(".submit").fadeIn("fast");
            $(".submit").css("display","flex");
            submitPage++;
        }
    })
    $("#back").click(function(){
        if(submitPage == 1){
                if(selectedimages[0]){
                    $("#1 input").hide();
                }else{
                    $("#1 textarea").hide();
                }
        
                if(selectedimages[1]){
                    $("#2 input").hide();
                }else{
                    $("#2 textarea").hide();
                }

                if(selectedimages[2]){
                    $("#3 input").hide();
                }else{
                    $("#3 textarea").hide();
                }

                if(selectedimages[3]){
                    $("#4 input").hide();
                }else{
                    $("#4 textarea").hide();
                }

                if(selectedimages[4]){
                    $("#5 input").hide();
                }else{
                    $("#5 textarea").hide();
                }

                if(selectedimages[5]){
                    $("#6 input").hide();
                }else{
                    $("#6 textarea").hide();
                }

                if(selectedimages[6]){
                    $("#7 input").hide();
                }else{
                    $("#7 textarea").hide();
                }

                if(selectedimages[7]){
                    $("#8 input").hide();
                }else{
                    $("#8 textarea").hide();
                }

                if(selectedimages[8]){
                    $("#9 input").hide();
                }else{
                    $("#9 textarea").hide();
                }

                $("#1 .picksquares").show();
                $("#2 .picksquares").show();
                $("#3 .picksquares").show();
                $("#4 .picksquares").show();
                $("#5 .picksquares").show();
                $("#6 .picksquares").show();
                $("#7 .picksquares").show();
                $("#8 .picksquares").show();
                $("#9 .picksquares").show();
                
                $("#back").hide();

            submitPage--;
            pickingimages = true;
        }
        else if(submitPage == 2){
            
            $(".gridrow input").prop("readonly",false);
            $(".gridrow textarea").prop("readonly",false);
            $(".gridrow input").prop("disabled",false);
            $(".gridrow textarea").prop("disabled",false);
            $("#next").fadeIn("fast");
            $(".submit").fadeOut("fast");
            submitPage--;
        }
    })

    $("#submitpicket").click(function(){
    });
}