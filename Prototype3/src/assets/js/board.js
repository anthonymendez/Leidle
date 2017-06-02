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
    //Reveals the signup and login menus.
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
            for(var i = 0; i < 9; i++){
                var dom = sprintf("#%i div",i+1);
                $(dom).hide();
            }

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
                for(var i = 0; i < 9; i++){
                    var inputdom = sprintf("#%i input", i+1);
                    var textareadom = sprintf("#%i textarea", i+1);
                    $(inputdom).remove();
                    $(textareadom).remove();
                }

                //Appends all the DOM as a child to each square
                for(var i = 0; i < 9; i++){
                    var dom = sprintf("#%i",i+1);
                    $(dom).append(input[i]);
                }

                appended = true;
            //Else, we just show the appropriate input and textareas.
            }else{
                for(var i = 0; i < 9;i++){
                    var dom = "";
                    if(selectedimages[i]){
                        dom = sprintf("#%i input",i+1);
                    }else{
                        dom = sprintf("#%i textarea",i+1);
                    }
                    $(dom).show();
                }
            }
            //Show the back button
            $("#back").show();
            //Increment page counter
            submitPage++;
            //We are not picking which box will have images
            pickingimages = false;
        }
        //Else if we're on the second page, save the values from each input box into the textboxes array.
        //Then made the input and textareas readonly and fadeout the next button and fadein the submit picket button
        else if(submitPage == 1){
            //Saving all the values from the input boxes into the textboxes array.

            for(var i = 0; i < 9; i++){
                var dom = "";
                if(selectedimages[i]){
                    dom = sprintf("#%i input",i+1);
                }else{
                    dom = sprintf("#%i textarea",i+1);
                }
                textboxes[i] = $(dom).value;
            }
            //Setting the input and textareas to disabled and readonlys
            $(".gridrow input").prop("readonly",true);
            $(".gridrow textarea").prop("readonly",true);
            $(".gridrow input").prop("disabled",true);
            $(".gridrow textarea").prop("disabled",true);
            //Gets rid of the next button because we're on the last page.
            $("#next").fadeOut("fast");
            //Creates the Submit button so the user can submit their picket.
            $(".submit").fadeIn("fast");
            //Applies the display:flex style design to the submit button
            $(".submit").css("display","flex");
            //Increment the current page we're on by one.
            submitPage++;
        }
    })
    //Goes back through each page of the "Create a Picket" system with different functions for each appropriate page.
    $("#back").click(function(){
        //If we're on the second page, hide all of the inputs and textareas we have, and reappear the image selection screen.
        if(submitPage == 1){
                //Hiding all the input boxes

                for(var i = 0; i < 9; i++){
                    var dom = "";
                    if(selectedimages[i]){
                        dom = sprintf("#%i input",i+1);
                    }else{
                        dom = sprintf("#%i textarea",i+1);
                    }
                    $(dom).hide();
                }
                //Showing all the picksquares elements (so users can pick their image squares again).
                for(var i = 0; i < 9; i++){
                    var dom = sprintf("#%i .picksquares",i+1);
                    $(dom).show();
                }
                //Hides the back button because we're on the first page.
                $("#back").hide();
                //Decrement our current page by one.
                submitPage--;
                //We're back to picking images so this is true
                pickingimages = true;
        }
        //If we're on the 3rd page
        else if(submitPage == 2){
            //Disable readonly and disabled on each input box so the user can edit their text
            $(".gridrow input").prop("readonly",false);
            $(".gridrow textarea").prop("readonly",false);
            $(".gridrow input").prop("disabled",false);
            $(".gridrow textarea").prop("disabled",false);
            //Show the next button because we're not on the last page anymore.
            $("#next").fadeIn("fast");
            //Hide the submit button because the user is still editing their picket.
            $(".submit").fadeOut("fast");
            //Decrement our curring page by one.
            submitPage--;
        }
    })
    //Submits the picket.
    //We're gonna have to go through some AJAX stuff, need to look into it.
    $("#submitpicket").click(function(){
        //TODO
    });
}