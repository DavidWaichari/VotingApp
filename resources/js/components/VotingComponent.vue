<template>
    <h1 class="text-center"  v-if="is_active && has_voted ===false">You have {{ no_of_choices - votes.length }} choices left</h1>
     <div class="row justify-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col"  v-for="(item, index) in candidates" :key="item.id" v-if="election.is_active === 'Yes' && has_voted === false">
            <div class="card" >
                <img v-if="item.image_url" :src="item.image_url" />
                <img v-else src="https://cdn-icons-png.flaticon.com/512/149/149071.png" />
                <div class="card-body">
                    <h3 class="text-center">{{item.name}}</h3>
                    <div class="align-items-center">
                        <button type="button" v-if="votes.includes(item.id)" @click="unvote(item.id)" class="w-100 btn btn-lg btn-block btn-danger">
                            <p style="vertical-align: inherit;"><p style="vertical-align: inherit;">REMOVE</p></p>
                        </button>
                        <div v-else>
                            <button type="button" v-if="votes.length < no_of_choices" @click="vote(item.id)" class="w-100 btn btn-lg btn-block btn-success">
                                <p style="vertical-align: inherit;"><p style="vertical-align: inherit;">SELECT</p></p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-danger m-5" role="alert" v-if="!is_active">
        <h1 class="text-center">This election is no longer active</h1>
    </div>
    <div class="alert alert-warning m-5" role="alert" v-if="has_voted">
        <h1 class="text-center">You have voted for this election. Wait for the results</h1>
    </div>
    <div class="d-flex justify-content-center m-3">
        <button v-if="has_voted ===false" type="button"  @click="saveVote" class="btn btn-primary btn-lg  w-50" :disabled="no_of_choices - votes.length != 0">{{no_of_choices - votes.length != 0 ? 'FINISH SELECTING CANDIDATES':'VOTE' }}</button>
    </div>
    </div>
    <div class="row" v-if="auth_user.can_vote ==='No'">
        <div class="alert alert-danger m-5" role="alert"  >
            <h1 class="text-center">You are not permitted to vote</h1>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const candidates = ref([]);
const election = ref({});

const votes = ref([]);
const no_of_choices = ref(0);
const auth_user = ref({});
const is_active = ref(false);
const has_voted = ref(false);

const pathSegments = window.location.pathname.split('/');

onMounted(() => {
    loadData();
});

const loadData = async () =>{
    const res = await axios.get('/auth_user');
    auth_user.value = res.data
   
    const response = await axios.get(`/elections/${pathSegments[2]}/ajax`);
    if (response.data.success) {
        candidates.value = response.data.data.candidates;
        election.value = response.data.data;
        no_of_choices.value = response.data.data.maximum_selections;
        is_active.value = true;
    }
    const response1 = await axios.get(`/elections/${pathSegments[2]}/has_voted`);
    if (response1.data.success) {
        has_voted.value = true;
    }
}

const vote = (candidate_id) => {
    votes.value.push(candidate_id);
}

const saveVote = async() => {
    const response  = await axios.post('/vote', {
        votes:votes.value,
        election_id: pathSegments[2]
    })
    loadData();
}

const unvote = (candidate_id) => {
    votes.value = votes.value.filter(id => id !== candidate_id);
}
</script>
