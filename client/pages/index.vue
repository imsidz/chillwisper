<template>
    <div>
        <h3>Random Video Lists</h3>
      <div class="row">
        <div class="col-md-3" v-for="video in videos" :key="video.id">
          <div class="card text-left">
            <nuxt-link :to="`/watch/${video.videoId}`" class="text-dark">
              <img class="card-img-top" :src="video.thumbnail" alt="">
              <div class="card-body">
                <h4 class="card-title">{{ video.title }}</h4>
                <p>{{ video.published_at }}</p>
              </div>
            </nuxt-link>
            
          </div>
        </div>

      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <h3>Random Channel</h3>
        </div>
        <div class="col-md-12" v-for="channel in channels" :key="channel.id">
            <h3>{{ channel.title }}</h3>
            <div class="row">
              <div class="col-md-3" v-for="video in channel.videos" :key="video.id">
                <div class="card text-left">
                  <nuxt-link :to="`/watch/${video.videoId}`" class="text-dark">
                    <img class="card-img-top" :src="video.thumbnail" alt="">
                    <div class="card-body">
                      <h4 class="card-title">{{ video.title }}</h4>
                      <p>{{ video.published_at }}</p>
                    </div>
                  </nuxt-link>
                  
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</template>

<script>

export default {
  async asyncData ({ $axios, params }) {
    let vid = await $axios.$get(`/videos`)
    let chann = await $axios.$get(`/channels`)
    return { videos: vid.data, channels: chann.data }
  },
  
}
</script>

<style>

</style>
