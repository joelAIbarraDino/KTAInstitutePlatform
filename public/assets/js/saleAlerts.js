(function(){

  const names = [
    "James", "Mary", "John", "Patricia", "Robert", "Jennifer", "Michael", "Linda", "William", "Elizabeth",
    "David", "Barbara", "Richard", "Susan", "Joseph", "Jessica", "Carlos", "Maria", "Alejandro", "Juana",
    "Miguel", "Isabella", "Antonio", "Luisa", "Javier", "Gabriela", "Andrés", "Camila", "Fernando", "Ana",
    "Christopher", "Nancy", "Daniel", "Lisa", "Matthew", "Betty", "Anthony", "Margaret", "Donald", "Sandra",
    "Luis", "Claudia", "Kevin", "Sofia", "Brian", "Michelle", "Edward", "Rosa", "Francisco", "Paola",
    "Jesus", "Valeria", "Ernesto", "Carolina", "Martin", "Liliana", "Oscar", "Verónica", "Juan", "Beatriz",
    "Arturo", "Silvia", "Hugo", "Patricia", "Raúl", "Lorena", "Jorge", "Gloria", "Emilio", "Elsa",
    "Victor", "Daniela", "Cesar", "Estefanía", "Ricardo", "María José", "Julio", "Mónica", "Alfonso", "Natalia",
    "Roberto", "Lucía", "Manuel", "Andrea", "Guillermo", "Marisol", "Eduardo", "Fernanda", "Federico", "Yolanda",
    "Armando", "Rebeca", "Ramón", "Angélica", "Salvador", "Brenda", "Joel", "Vanessa", "Marco", "Yesenia",
    "Pablo", "Diana", "Isaac", "Karen", "Pedro", "Marina", "Tomas", "Adriana", "Leonardo", "Violeta",
    "Esteban", "Paty", "Rafael", "Alejandra", "Santiago", "Maribel", "Diego", "Nancy", "Mateo", "Julieta",
    "Noah", "Emma", "Liam", "Ava", "Jacob", "Mia", "Logan", "Chloe", "Lucas", "Samantha",
    "Jayden", "Emily", "Benjamin", "Aria", "Mason", "Luna", "Elijah", "Sofia", "Ethan", "Isla",
    "Sebastián", "Renata", "Gael", "Jimena", "Emiliano", "Regina", "Dylan", "Aitana", "Thiago", "Abril",
    "Adriel", "Florencia", "Bruno", "Romina", "Ian", "Belen", "Alan", "Antonia", "Ivan", "Maite",
    "Mauricio", "Constanza", "Axel", "Bianca", "Luciano", "Elena", "Joaquín", "Melina", "Facundo", "Valentina",
    "Franco", "Catalina", "Matías", "Zoe", "Maximiliano", "Josefina", "Nicolás", "Agustina", "Cristian", "Carla"
  ];

  const cities = [
    "Los Angeles", "New York", "Miami", "Houston", "Chicago", "Phoenix", "San Antonio", "San Diego", "Dallas", "San Jose",
    "El Paso", "Las Vegas", "Orlando", "Austin", "Tucson", "Denver", "San Francisco", "Fort Worth", "Albuquerque", "Fresno",
    "Sacramento", "Long Beach", "Bakersfield", "Tampa", "Atlanta", "Santa Ana", "Hialeah", "Anaheim", "Stockton", "Riverside",
    "Chula Vista", "San Bernardino", "Oxnard", "Modesto", "Glendale", "Laredo", "Brownsville", "McAllen", "Corpus Christi", "Wichita",
    "Garland", "Arlington", "Mesa", "Charlotte", "Newark", "Paterson", "Jersey City", "Union City", "Elizabeth", "Bridgeport",
    "Yonkers", "Springfield", "Pasadena", "Hollywood", "Kissimmee", "Cape Coral", "Lakeland", "Pomona", "Salinas", "Santa Clara",
    "Fullerton", "Escondido", "Moreno Valley", "Perris", "Delano", "Santa Maria", "El Monte", "Huntington Park", "Bell", "Cicero",
    "Phoenix", "Oakland", "Minneapolis", "Cleveland", "Detroit", "Baltimore", "Seattle", "Washington", "Boston", "Columbus",
    "Nashville", "Indianapolis", "Milwaukee", "Kansas City", "St. Louis", "Cincinnati", "Omaha", "Toledo", "Reno", "Boise",
    "Spokane", "Anchorage", "Honolulu", "Chandler", "Scottsdale", "Irvine", "Plano", "Tempe", "Aurora", "North Las Vegas"
  ];  
  function getRandomItem(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
  }

  function showFakePurchase() {
    const name = getRandomItem(names);
    const city = getRandomItem(cities);
    const popup = document.getElementById("purchase-popup");
    const text = document.getElementById("popup-text");

    text.innerText = `¡${name} de ${city}, USA es un nuevo estudiante y compró un curso¡`;
    popup.classList.remove("hidden");
    popup.classList.add("visible");

    setTimeout(() => {
      popup.classList.remove("visible");
      popup.classList.add("hidden");
    }, 5000);
  }

  function loopPopups() {
    const interval = Math.floor(Math.random() * 15000) + 20000;
    setTimeout(() => {
      showFakePurchase();
      loopPopups();
    }, interval);
  }

  window.addEventListener("load", () => {
    setTimeout(() => {
      showFakePurchase();
      loopPopups();
    }, 3000);
  });

  window.addEventListener('DOMContentLoaded', ()=>{
    const whatsappPopup = document.querySelector(".whatsapp");

    whatsappPopup.addEventListener('mouseover', ()=>{
      const tooltip = document.querySelector('.whatsapp__tooltip');

      tooltip.classList.add('active');
    });

    whatsappPopup.addEventListener('mouseout', ()=>{
      const tooltip = document.querySelector('.whatsapp__tooltip');

      tooltip.classList.remove('active');
    });
  })

})();