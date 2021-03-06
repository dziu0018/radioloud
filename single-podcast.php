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

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
the_content();
?>

        <button class="back-button">Tilbage til oversigt</button>
        <article class="mainarticle">
            <img class="pic" src="" alt="">
            <div>
                <h1></h1>
                <p class="lang_beskrivelse"></p>
                <a class="spotify" href="">
                    <img class="spotifybillede" src="#" alt="">
                </a>
            </div>
        </article>

        <section id="episode">
            <template>
                <article class="underarticle">
                    <div class="articlegrid">
                        <div>
                            <img class="pic2 " src="" alt="">
                        </div>
                        <div>
                            <h2></h2>
                            <p></p>
                            <audio controls class="afspillyden" src="#"></audio>
                            <a class="download" href="#">Download</a>
                            <a class="episodespotify" href="">
                                <img class="episodespotifybillede" src="#" alt="">
                            </a>
                        </div>
                    </div>
                </article>
            </template>
        </section>
    </main>

</div>

<style>
    body {
        padding: 0;
        margin: 0;
        background-color: background: rgb(242, 150, 78);
        background: linear-gradient(180deg, rgba(242, 150, 78, 1) 0%, rgba(250, 80, 122, 1) 100%);
    }

    main {
        padding-right: 40px;
        padding-left: 40px;

    }

    .pic {
        width: 20em;
    }

    .pic2 {
        width: 12em;
    }

    h2 {
        color: white;
        height: 3em;
        font-size: 1em;
        font-family: 'Josefin Sans', sans-serif;
        color: black;
    }

    h1 {
        font-family: 'Josefin Sans', sans-serif;
        color: #DBAA1F;
    }

    p {
        font-family: 'Josefin Sans', sans-serif;
        color: black;
    }

    .mainarticle {
        background: rgb(242, 242, 237);
        background: linear-gradient(180deg, rgba(242, 242, 237, 1) 0%, rgba(219, 219, 219, 1) 100%);
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-gap: 0.8em;


    }


    .articlegrid {
        background: rgb(252, 195, 208);
        color: white;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        grid-gap: 0.8em;
    }

    #filtrering {
        padding: 20px;
    }

    button {
        margin: 10px;
        color: white;
        background-color: #333333
    }

    .back-button {
        margin: 10px;
        color: #DB083A;
        background-color: #FFFFFF;
        font-size: 1.3em;
        font-family: 'Josefin Sans';
        font-weight: 500;
        transition: 0.2s ease-out;
    }

    .back-button:hover {
        transform: scale(1.02);
        cursor: pointer;
        background-color: #FFFFFF;
        color: #DB083A;
    }

    .download {
        margin: 10px;
        color: #DB083A;
        background-color: #FFFFFF;
        font-size: 1.3em;
        font-family: 'Josefin Sans';
        font-weight: 500;
        transition: 0.2s ease-out;
        padding: 10px;
    }

    .lyt-her-knap:hover {
        transform: scale(1.02);
        cursor: pointer;
        background-color: #FFFFFF;
        color: #DB083A;
    }



    a {
        color: #DB083A;
    }

    .pic {
        border: 5px solid white;
        cursor: pointer;
    }

    .pic2 {
        border: 5px solid white;
        cursor: pointer;
    }

    .spotifybillede {
        width: 40px;
    }

    .episodespotifybillede{
        width: 40px;
    }

</style>

<script>
    let podcast;
    let episode;
    let aktuelpodcast = <?php echo get_the_ID() ?>;

    console.log("aktuelpodcast: ", aktuelpodcast);

    const dbUrl = "http://dziugas.dk/kea/2semester/tema9/radio_loud/wordpress/wp-json/wp/v2/podcast/" + aktuelpodcast;
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
        document.querySelector(".pic").src = podcast.billede.guid;
        document.querySelector(".pic").alt = podcast.billede.post_title;
        document.querySelector(".lang_beskrivelse").innerHTML = podcast.lang_beskrivelse;
        document.querySelector(".back-button").addEventListener("click", tilbageTilListe);
        document.querySelector(".spotify").href = podcast.spotify;
        document.querySelector(".spotifybillede").src = podcast.spotifylogo.guid;
    }

    function visEpisode() {
        console.log("visEpisode");
        let temp = document.querySelector("template");
        episode.forEach(episode => {
            console.log("loop id :", aktuelpodcast);
            if (episode.horer_til_podcast == aktuelpodcast) {
                console.log("loop k??rer id :", aktuelpodcast);
                let klon = temp.cloneNode(true).content;
                klon.querySelector("img").src = episode.billede.guid;
                klon.querySelector("img").alt = episode.billede.post_title;
                klon.querySelector("h2").innerHTML = episode.title.rendered;
                /*klon.querySelector("p").innerHTML = episode.lang_beskrivelse;*/
                klon.querySelector(".download").href = episode.afspilknappen;
                klon.querySelector(".afspillyden").src = episode.afspilknappen;
                klon.querySelector(".episodespotify").href = episode.spotify;
                klon.querySelector(".episodespotifybillede").src = episode.episodespotifylogo.guid;
                console.log("episode", episode.link);
                container.appendChild(klon);
            }
        })
    }
    getJson();

    function tilbageTilListe() {
        history.back();
    }

</script>


<!-- #primary -->


<?php
get_footer();
