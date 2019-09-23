<template>
    <div>
        <form @submit.prevent="save">
            <div class="form-group">
              <label>Video ID</label>
              <input type="text" class="form-control" placeholder="https://www.youtube.com/watch?v=qFkNATtc3mc" required v-model="form.video">
              <small class="text-danger">error message</small>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return {
            form: {
                video: ''
            }
        }
    },
    methods: {
        save(){
            this.$axios.post('/admin/add-video', {
                video: this.form.video
            })
            .then(response => {
                console.log(response);
                
            })
        }
    }
}
</script>