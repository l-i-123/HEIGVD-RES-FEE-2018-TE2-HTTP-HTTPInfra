const Chance = require('chance');
const chance = new Chance();

var ip = require('ip');

const express = require('express');
const app = express();


app.get('/students', function (req, res) {
  res.send(generatePerson());
})

app.get('/getip', function (req, res) {
  res.send(ip.address());
})

app.listen(3000, function () {
  console.log('Example app listening on port 3000!');
})

function generatePerson(){
	var nbOfPersons = chance.integer({min: 1, max: 20});
	var persons = [];
	var i;
	for(i = 0; i < nbOfPersons; i++){
		var sex = chance.gender();
		var birthYear = chance.year({max: 2018});
		persons.push({
			nom: chance.name({gender: sex}), 
			age: chance.age(), 
			taille: chance.floating({ min: 1.5, max: 2.5, fixed: 2}),
			animal_de_compagnie: chance.animal({type: 'zoo'})
			});
	}
	return persons;
}