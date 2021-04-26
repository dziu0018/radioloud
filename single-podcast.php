<?php
/**
* The template for displaying front page



*/



get_header();
?>



<div id="primary" class="content-area">
    <main id="main" class="site-main">



        <article>
            <img class="pic" src="" alt="">
            <img class="episodepic" src="" alt="">



            <div>
                <h1></h1>
                <p class="lang_beskrivelse"></p>
            </div>
        </article>



        <section id="episode">
            <template>
                <article>
                    <img src="" alt="">
                    <div>
                        <h2></h2>
                        <p></p>
                        <a href="">Læs mere</a>
                    </div>
                </article>
            </template>
        </section>
    </main>
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
            width: 20em;
        }



        h2 {
            color: white;
            height: 3em;
            font-size: 1em;
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

    </style>



    <script>
        let podcast;
        let episode;
        let aktuelepisode = <?php echo get_the_ID() ?>;



        console.log("aktuelepisode: ", aktuelepisode);



        const dbUrl = "http://dziugas.dk/kea/2semester/tema9/radio_loud/wordpress/wp-json/wp/v2/episode/" + aktuelepisode;
        const episodeUrl = "http://dziugas.dk/kea/2semester/tema9/radio_loud/wordpress/wp-json/wp/v2/episode?per_page=100";



        const container = document.querySelector("#episode");



        async function getJson() {
            const data = await fetch(dbUrl);
            podcast = await data.json();
            console.log("podcast linje 51: ", podcast);
            const data2 = await fetch(episodeUrl)
            episode = await data2.json();
            console.log("episode: ", episode);



            visPodcasts();
            visEpisode();
        }



        function visPodcasts() {
            console.log("visPodcasts");
            console.log(podcast);
            document.querySelector("h1").innerHTML = podcast.title.rendered;
            document.querySelector("img").src = podcast.billede.guid;
            document.querySelector(".lang_beskrivelse").innerHTML = podcast.lang_beskrivelse;
        }



        function visEpisode() {
            console.log("visEpisode");
            let temp = document.querySelector("template");
            episode.forEach(episode => {
                console.log("loop id :", aktuelepisode);
                if (episode.horer_til_podcast == aktuelepisode) {
                    console.log("loop kører id :", aktuelepisode);
                    let klon = temp.cloneNode(true).content;
                    klon.querySelector("h2").innerHTML = episode.title.rendered;
                    klon.querySelector("p").innerHTML = episode.lang_beskrivelse;
                    klon.querySelector(".episodepic") = episode.billede.guid;
                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = episode.link;
                    })



                    klon.querySelector("a").href = episode.link;
                    console.log("episode", episode.link);
                    container.appendChild(klon);
                }
            })
        }
        getJson();

    </script>




</div>
<!-- #primary -->




<?php
get_footer();
