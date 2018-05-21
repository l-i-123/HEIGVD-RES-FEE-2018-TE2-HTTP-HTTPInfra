$(function(){
        console.log("loading students");

        function loadStudents(){
        $.getJSON("/api/students/", function(students){
                console.log(students);
                var message = "Nobody is here";
                if(students.length > 0){
                        message = "welcome to HEIG-VD" + " " + students[0].nom;
                }
                $(".navbar-brand").text(message);
        });
     };
     loadStudents();
     setInterval(loadStudents, 2000);
});