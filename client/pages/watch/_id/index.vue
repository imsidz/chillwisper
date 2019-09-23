<template>
    <div>
        <youtube :video-id="video.videoId" :player-vars="playerVars" @playing="playing"></youtube>
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
                autoplay: 1
            }
        }
    },
    methods: {
        playing() {
            console.log('\o/ we are watching!!!')
        }
    }

}
</script>