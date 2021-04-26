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

        <article class="mainarticle">
            <img class="pic" src="" alt="">
            <div>
                <h1></h1>
                <p class="lang_beskrivelse"></p>
            </div>
        </article>

        <section id="episode">
            <template>
                <article class="underarticle">
                    <div class="articlegrid">
                        <div>
                            <img src="" alt="">
                        </div>
                        <div>
                            <h2></h2>
                            <p></p>
                            <a href="">Lyt her</a>
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
    }

    main {
        padding-right: 40px;
        padding-left: 40px;
    }

    .pic {
        width: 29em;
    }

    img {
        width: 20em;
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
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        grid-gap: 0.8em;


    }


    .articlegrid {
        background: rgb(252, 195, 208);
        color: white;
        padding: 20px;
        cursor: pointer;
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

    .pic {}

    a{
        color: #DB083A;
    }

    img{
        border: 5px solid white;
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
    }

    function visEpisode() {
        console.log("visEpisode");
        let temp = document.querySelector("template");
        episode.forEach(episode => {
            console.log("loop id :", aktuelpodcast);
            if (episode.horer_til_podcast == aktuelpodcast) {
                console.log("loop kører id :", aktuelpodcast);
                let klon = temp.cloneNode(true).content;
                klon.querySelector("img").src = episode.billede.guid;
                klon.querySelector("img").alt = episode.billede.post_title;
                klon.querySelector("h2").innerHTML = episode.title.rendered;
                klon.querySelector("p").innerHTML = episode.lang_beskrivelse;
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


<!-- #primary -->


<?php
get_footer();
