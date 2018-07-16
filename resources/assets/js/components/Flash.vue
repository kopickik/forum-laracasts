<template>
    <div
        id="alert-flash"
        class="alert-flash alert alert-success"
        role="alert"
        :class="'alert-'+severity"
        v-show="show"
        v-text="body">
    </div>
</template>

<script>
export default {
    props: ['message', ],
    data () {
        return {
            icon: this.icon,
            body: this.message,
            severity: 'info',
            show: false
        }
    },

    created() {
        if (this.message) {
            this.flash();
        }

        window.events.$on('flash', data => this.flash(data));
    },

    methods: {
        flash(data) {
            if (data) {
                this.icon = data.icon;
                this.body = data.message;
                this.severity = data.severity;
            }

            this.show = true;

            this.hide();
        },
        hide() {
            setTimeout(() => {
                this.show = false;
            }, 2500);
        }
    }
}
</script>

<style lang="sass">
    .alert-flash
        position: fixed
        bottom: 2em
        right: 2em

</style>
