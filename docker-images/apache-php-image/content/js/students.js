$(function(){
        console.log("loading students");

		//Fonction loadStudent
        function loadStudents(){
		
		//requête ajax récupérant le code JSON retourné par le serveur dynamique
        $.getJSON("/api/students/", function(students){
                console.log(students);
                var message = "Nobody is here";
                if(students.length > 0){
						//students[0].nom permet de récupérer le nom du premier student 
                        message = "welcome to HEIG-VD" + " " + students[0].nom;
                }
				//Le texte de message est affiché à partout où la classe navbar-brand est trouvé
                $(".navbar-brand").text(message);
        });
     };
	 //appel de la fonction loadStudents
     loadStudents();
	 
	 //rechargement de la fonction toute les 2 secondes
     setInterval(loadStudents, 2000);
});