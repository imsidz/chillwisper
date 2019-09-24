<template>
    <div>
        <youtube ref="youtube" :video-id="video.videoId" :player-vars="playerVars" @playing="playing"></youtube>
        <br>
        <button class="btn btn-danger" @click="play">Play</button>
        <button class="btn btn-danger" @click="pause">Pause</button>
        <br>
        Check Console for all events
        <p>{{ video.title }}</p>
        <div v-html="video.description">

        </div>
    </div>
</template>

<script>
export default {
    async asyncData ({ $axios, params }) {
        let { data } = await $axios.$get(`/watch/${params.id}`)
        return { video: data }
    },
    data() {
        return {
            playerVars: {
                autoplay: 1,
                modestbranding: 1,
                showinfo: 0
            }
        }
    },
    methods: {
        playing() {
            console.log('\o/ we are watching!!!')
        },
        play(){
            this.player.playVideo()
        },
        pause(){
            this.player.pauseVideo()
        }
    },
    computed: {
        player() {
            return this.$refs.youtube.player
        }
    },
    mounted(){
        console.log(this.player);
    }

}
</script>