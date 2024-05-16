<template>
     <div class="row justify-content-center" v-if="can_vote === 'Yes'">
        <h1 class="text-center text-bold">VOTING SYSTEM</h1>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" v-if="has_voted">
        <div class="col" v-for="(item, index) in candidates" :key="item.id">
            <div class="card" >
                <img v-if="item.image_url" :src="item.image_url" />
                <img v-else src="https://cdn-icons-png.flaticon.com/512/149/149071.png" />
                <div class="card-body">
                    <h3 class="text-center">{{item.name}}</h3>
                    <div class="align-items-center">
                        <button type="button" v-if="votes.includes(item.id)" @click="unvote(item.id)" class="w-100 btn btn-lg btn-block btn-danger">
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">DELETE</font></font>
                        </button>
                        <div v-else>
                            <button v-if="no_of_choices <= 3 " type="button"  @click="vote(item.id)" class="w-100 btn btn-lg btn-block btn-secondary">
                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">SELECT</font></font>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success m-5" role="alert" v-else>
        <h1 class="text-center">You have voted. Wait for the results</h1>
    </div>
    <div class="d-flex justify-content-center m-3" v-if="has_voted">
        <button type="button" @click="saveVote" class="btn btn-primary btn-lg  w-50">VOTE</button>
    </div>
    </div>
    <div class="row" v-else>
        <div class="alert alert-danger m-5" role="alert" >
            <h1 class="text-center">You are not permitted to vote</h1>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const candidates = ref([]);

const votes = ref([]);
const no_of_choices = ref(1);
const has_voted = ref(false)
const can_vote = ref('')

onMounted(async() => {
    //check if the user can vote
    const res = await axios.get('/auth_user');
    if (res.data.has_voted) {
        has_voted.value = false;
    }else{
        has_voted.value = true;
    }
    can_vote.value = res.data.can_vote
    const results = await axios.get('/candidates/ajax');
    candidates.value = results.data;
});

const vote = (candidate_id) => {
    votes.value.push(candidate_id);
    no_of_choices.value ++;
}

const saveVote = async() => {
    const response  = await axios.post('/vote', {
        votes:votes.value
    })
    has_voted.value = false;
}

const unvote = (candidate_id) => {
    votes.value = votes.value.filter(id => id !== candidate_id);
    no_of_choices.value --;
}
</script>
