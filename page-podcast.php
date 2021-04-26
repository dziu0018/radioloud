<?php
/**
* The template for displaying front page

*/





get_header();



?>
<?php
the_content();
?>



<main id="main" class="site-main">
    <h1>Alle</h1>
    <div class="valgt"></div>
    <nav id="filtrering"></nav>
    <div id="podcast-oversigt">
    </div>
</main>



<template>
    <article>
        <h2></h2>
        <img src="" alt="">
        <p class="kort_beskrivelse"></p>
    </article>
</template>



<style>
    body {
        padding: 0;
        margin: 0;
        background-color: #db083a;
    }

    main {
        padding-right: 40px;
        padding-left: 40px;
    }

    #podcast-oversigt {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-gap: 0.8em;
    }

    img {
        width: 100%;
    }

    h2 {
        color: white;
    }

    article {
        color: white;
        background-color: #331119;
        padding: 20px;
        cursor: pointer;
    }

    #filtrering {
        padding: 20px;
    }

    button {
        margin: 10px;
        color: white;
        background-color: #333333
    }

    .valgt {
        background-color: white;
    }

    button.active {
        color: red;
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
