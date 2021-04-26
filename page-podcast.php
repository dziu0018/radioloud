<?php
/**
* The template for displaying front page

*/





get_header();
?>


<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<main id="main" class="site-main">
    <?php
the_content();
?>
    <nav id="filtrering"></nav>
    <h1>Alle</h1>
    <div id="podcast-oversigt">
    </div>
</main>



<template>
    <article>
        <img class="podcastpic" src="" alt="">
        <h2></h2>
        <p class="kort_beskrivelse"></p>
    </article>
</template>



<style>
    body {
        padding: 0;
        margin: 0;
        background: rgb(255, 225, 166);
        background: linear-gradient(180deg, rgba(255, 225, 166, 1) 0%, rgba(255, 240, 209, 1) 100%);
    }

    main {
        padding-right: 40px;
        padding-left: 40px;
        width: 100%;

    }

    #podcast-oversigt {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-gap: 0.8em;
    }

    .podcastpic {
        width: 100%;
        border: 5px solid white;
    }

    h2 {
        color: black;
        font-family: 'Josefin Sans', sans-serif;
    }

    h1 {
        text-align: center;
        color: #DBAA1F;
        font-family: 'Josefin Sans', sans-serif;
    }

    p {
        color: black;
    }

    article {
        padding: 20px;
        cursor: pointer;
        border
    }

    .menu-toggle,
    button,
    .ast-button,
    .ast-custom-button,
    .button,
    input#submit,
    input[type="button"],
    input[type="submit"],
    input[type="reset"] {
        padding-left: 10px;
        padding-right: 10px;
        background-color: #DB083A;

    }

    #filtrering {
        padding: 20px;
        text-align: center;
    }

    button {
        font-size: 2em;
        margin: 10px;
        color: #DB083A;
        transition: 0.2s linear;
        background-color: rgba(51, 51, 51, 0);
        border-radius: 6px;
        padding: 0.8em 0.2em 0.8em 0.2em;
    }

    button:hover {
        transform: scale(1.1);
        color: #DBAA1F;
        background-color: rgba(51, 51, 51, 0);
        cursor: pointer;
    }

    button.active {
        color: #DBAA1F;
    }

    button:focus {
        border-color: rgba(51, 51, 51, 0);
        background-color: rgba(51, 51, 51, 0);
    }

</style>



<script>
    let podcasts = [];



    let categories;



    let filterCategory = "alle";

    const header = document.querySelector("h1");



    const liste = document.querySelector("#podcast-oversigt");




    const skabelon = document.querySelector("template");
    let filterPodcast = "alle";



    // når DOM er loadet kalder den efter funktionen "start"
    document.addEventListener("DOMContentLoaded", start)




    // første funktion der kaldes efter DOM er loaded
    function start() {
        console.log("start");
        getJson();
    }



    const url = "http://dziugas.dk/kea/2semester/tema9/radio_loud/wordpress//wp-json/wp/v2/podcast?per_page=100";



    const catUrl = "http://dziugas.dk/kea/2semester/tema9/radio_loud/wordpress//wp-json/wp/v2/categories";



    async function getJson() {
        console.log("getJson");
        let response = await fetch(url);
        let catresponse = await fetch(catUrl);
        podcasts = await response.json();
        categories = await catresponse.json();
        console.log(categories);
        visPodcasts();
        opretknapper();
    }



    function opretknapper() {



        // ----------------------------------------------------------------- "data-podcast"



        //   categories.forEach(cat => {
        //  document.querySelector("#filtrering").innerHTML += `<button class="filter active" data-podcast="${cat.id}">${cat.name}</button>`
        //})

        categories.forEach(cat => {
            if (cat.name == "Alle") {
                document.querySelector("#filtrering").innerHTML += `<button class="filter active" data-podcast="${cat.id}">${cat.name}</button>`
            } else {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
            }
        })



        addEventListenerToButtons();



    }








    function addEventListenerToButtons() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.addEventListener("click", filtrering)
        })
    }



    function filtrering() {
        document.querySelectorAll("#filtrering button").forEach(elm => {
            elm.classList.remove("active")
        });
        filterPodcast = this.dataset.podcast;
        console.log(filterPodcast);
        header.textContent = this.textContent;
        this.classList.add("active");




        visPodcasts();
    }




    function visPodcasts() {
        console.log(podcasts);
        liste.innerHTML = "";
        podcasts.forEach(podcasts => {
            if (filterPodcast == "alle" || podcasts.categories.includes(parseInt(filterPodcast))) {
                const klon = skabelon.cloneNode(true).content;
                klon.querySelector("h2").textContent = podcasts.title.rendered;
                // --------------------------------------------------------------------------------"podcasts"
                klon.querySelector("img").src = podcasts.billede.guid;
                klon.querySelector("img").alt = podcasts.billede.post_title;
                klon.querySelector(".kort_beskrivelse").innerHTML = podcasts.kort_beskrivelse;
                klon.querySelector("article").addEventListener("click", () => {
                    location.href = podcasts.link;
                })
                liste.appendChild(klon);
            }
        })
    }

</script>



<?php
get_footer();
