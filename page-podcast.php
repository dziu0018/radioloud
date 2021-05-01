<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<style>
    .elementor-2 .elementor-element.elementor-element-d92a599>.elementor-widget-container {
        padding: 0px 0px 0px 0px;
    }

    .elementor-2 .elementor-element.elementor-element-30d546a>.elementor-widget-container {
        padding: 0px 0px 0px 0px;
    }

    .elementor-2 .elementor-element.elementor-element-6887c27 .elementor-divider__text {
        font-size: 2em;
    }

    .elementor-2 .elementor-element.elementor-element-aac72e2 .elementor-divider__text {
        font-size: 2em;
    }

    .elementor-2 .elementor-element.elementor-element-9dd4624 {
        padding: 0px 0px 0px 0px;
    }

    .elementor-2 .elementor-element.elementor-element-8194d2b .elementor-swiper-button-next:hover {
        background-color: #000000a6;
    }

    .elementor-2 .elementor-element.elementor-element-8194d2b .elementor-swiper-button-prev:hover {
        background-color: #000000a6;
    }

    .elementor-2 .elementor-element.elementor-element-05d198e .elementor-swiper-button-next:hover {
        background-color: #000000a6;
    }

    .elementor-2 .elementor-element.elementor-element-05d198e .elementor-swiper-button-prev:hover {
        background-color: #000000a6;
    }

</style>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php astra_primary_content_top(); ?>

    <?php astra_content_page_loop(); ?>

    <?php astra_primary_content_bottom(); ?>

    <main id="main" class="site-main">
        <div>
            <section class="topsection">
            </section>
        </div>
        <nav id="filtrering"></nav>
        <div id="podcast-oversigt">
        </div>
    </main>


    <template>
        <article class="podcastarticle">
            <img class="podcastpic" src="" alt="">
            <h2></h2>
            <p class="kort_beskrivelse"></p>
        </article>
    </template>





    <style>
        body {
            padding: 0;
            margin: 0;
            background: rgb(255, 144, 132);
            background: linear-gradient(180deg, rgba(255, 144, 132, 1) 34%, rgba(237, 76, 95, 1) 100%);
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
            color: white;
            font-family: 'Josefin Sans', sans-serif;
        }

        h1 {
            padding-top: 70px;
            text-align: center;
            color: #ffffff;
            font-family: 'Josefin Sans', sans-serif;
            font-size: 5em;
        }

        .topp {
            color: white;
            font-family: 'Open Sans', sans-serif;
            text-align: center;
            font-size: 1.2em;
        }

        p {
            color: white;
            font-family: 'Open Sans', sans-serif;
        }

        .podcastarticle {
            padding: 20px;
            cursor: pointer;
            transition: 0.2s ease-out;
        }

        .podcastarticle:hover {
            transform: scale(1.02);
        }

        .topsection {}

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
            color: black;
            transition: 0.2s linear;
            background-color: rgba(51, 51, 51, 0);
            border-radius: 6px;
            padding: 0.8em 0.2em 0.8em 0.2em;
        }

        button:hover {
            transform: scale(1.1);
            color: #DB083A;
            background-color: rgba(51, 51, 51, 0);
            cursor: pointer;
        }

        button.active {
            color: #DB083A;
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





            // categories.forEach(cat => {
            // document.querySelector("#filtrering").innerHTML += `<button class="filter active" data-podcast="${cat.id}">${cat.name}</button>`
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




</div>
<!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
