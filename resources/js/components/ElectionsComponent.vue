<template>
     <div class="row justify-content-center">
        <h1 class="text-center text-bold">VOTING SYSTEM</h1>
        <h3 class="text-center text-bold ">Active Elections</h3>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col" v-for="election in elections" v-if="auth_user.can_vote === 'Yes'">
            <div class="card" >
                <div class="card-body alert alert-warning">
                    <div class="alert alert-success alert-dismissible">
                        <h1 class="text-center"><i class="icon fas fa-ban"></i> {{ election.position_name }} </h1>
                    </div>
                    <h4 class="text-center">{{ election.candidates.length }} Candidates</h4>
                    <h4 class="text-center">{{ election.maximum_selections }} Maximum Selections</h4>
                    <div class="align-items-center">
                        <div>
                            <a v-if="!election.auth_user_has_voted"  :href="`/elections/${ election.id }/participate`" type="button"  class="w-100 btn btn-lg btn-block btn-primary">
                            <p style="vertical-align: inherit; font-weight: bolder; font-size: 34PX;">PARTICIPATE</p>
                            </a>
                            <button v-if="election.auth_user_has_voted" disabled class="w-100 btn btn-lg btn-block btn-success">
                            <p style="vertical-align: inherit; font-weight: bolder; font-size: 34PX;">PARTICIPATED</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-danger m-5" role="alert" v-if="auth_user.can_vote === 'No'">
            <h1 class="text-center">You are not permitted to vote</h1>
        </div>
    </div>
    <div class="alert alert-danger m-5" role="alert" v-if="!active_elections">
        <h1 class="text-center">There are no active elections available at this time.</h1>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const elections = ref([]);
const auth_user = ref({});
const active_elections = ref(true);

onMounted(async() => {
    const response = await axios.get('/elections/ajax');
    elections.value = response.data;
    if (elections.value.length < 1) {
        active_elections.value = false;
    }
    const res = await axios.get('/auth_user');
    auth_user.value = res.data
});
</script>
