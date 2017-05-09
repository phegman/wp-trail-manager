<template>
    <div class="trails">
        <div class="status-btns" v-if="trailsData.length > 0">
            <button class="close-all button" value="Close All Trails" @click.prevent="changeAllTrailStatuses('Closed')">Close All Trails</button>
            <button class="caution-all button" value="Caution All Trails" @click.prevent="changeAllTrailStatuses('Caution')">Caution All Trails</button>
            <button class="open-all button" value="Open All Trails" @click.prevent="changeAllTrailStatuses('Open')">Open All Trails</button>
        </div><!-- /.status-btns -->
        <draggable v-model="trailsData" :options="{group:'trails', handle: '.trail-status-bar'}" @start="drag=true" @end="drag=false">
            <div v-for="trail, index in trailsData" 
            v-bind:class="[
                'trail',
                'container-fluid',
                drag ? 'drag-collapse' : ''
            ]"
            >
                <button class="remove-trail" @click.prevent="removeTrail(index)"></button>
                <div
                v-bind:class="[
                    trail.status == 'Open' ? 'status-open' : '',
                    trail.status == 'Caution' ? 'status-caution' : '',
                    trail.status == 'Closed' ? 'status-closed' : '',
                    'trail-status-bar'
                ]"
                ></div>
                <h3 v-if="trail.name != ''"class="trail-title">{{ trail.name }}</h3>
                <h3 v-else class="trail-title">Trail Name</h3>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="trail_name">Trail Name</label>
                        <input class="form-control" type="text" name="trail_name" placeholder="Trail Name" v-model="trail.name" />
                    </div><!-- /.form-group -->
                    <div class="form-group col-md-6">
                        <label>Trail Notes</label>
                        <textarea class="description form-control" v-model="trail.description"></textarea>
                    </div><!-- /.form-group -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="trail_length">Trail Length (Miles)</label>
                        <input type="number" name="trail_length" step="any" class="trail-length form-control" v-model="trail.length" />
                    </div><!-- /.form-group -->
                    <div class="form-group col-md-4">
                        <label>Trail Status</label>
                        <select class="trail-status form-control" v-model="trail.status">
                            <option value="Open">Open</option>
                            <option value="Caution">Caution</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div><!-- /.form-group -->
                    <div class="form-group col-md-4">
                        <label>Difficulty</label>
                        <select class="trail-difficulty form-control" v-model="trail.difficulty">
                            <option value="green">Green Circle</option>
                            <option value="blue">Blue Square</option>
                            <option value="black">Black Diamond</option>
                            <option value="double_black">Double Black Diamond</option>
                        </select>
                    </div><!-- /.form-group -->
                </div><!-- /.row -->
            </div>
        </draggable>
        <button class="add-trail button-primary" value="Add Trail" @click.prevent="addTrail">Add Trail</button>
    </div><!-- /.trails -->
</template>

<script>
    import draggable from 'vuedraggable'
    import { mapGetters } from 'vuex';

    export default {
        components: {
            draggable,
        },
        data() {
            return {
                drag: false,
                trailsData: this.onLoadTrailsData
            }
        },
        props: {
            onLoadTrailsData: {
                type: Array,
                required: true
            }
        },
        methods: {
            addTrail() {
                const trail = {
                    name: "",
                    status: "Open",
                    difficulty: "green",
                    description: "",
                    length: "",
                };
                this.$store.commit('addTrail', trail);
            },
            changeAllTrailStatuses(status) {
                this.$store.commit('changeAllTrailStatuses', status);
            },
            removeTrail(index) {
                this.$store.commit('removeTrail', index);
            }
        },
        watch: {
            trailsData: {
                handler(val, oldVal) {
                    this.$store.commit('updateTrailsData', val);
                },
                deep: true
            },
        },
        mounted() {
            this.$store.commit('updateTrailsData', this.onLoadTrailsData);
        }
    }
</script>