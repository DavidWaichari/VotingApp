<template>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ candidates.length }}</h3>

                        <p>Candidates</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/admin/candidates" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ registered_voters_count }}</h3>

                        <p>Registered Voters</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/admin/voters?status=registered" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ voters_count }}</h3>

                        <p>Voters Voted</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/admin/voters?status=registered" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ unregistered_voters_count }}</h3>

                        <p>Unregistered Voters</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/admin/voters?status=unregistered" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-4">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ votes_count }}</h3>

                        <p>All Votes Cast</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Candidates</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table  class="table table-bordered table-striped" style="font-size: 20px;">
                        <thead>
                        <tr>
                          <th class="text-center">SNO</th>
                          <th>Picture</th>
                          <th>Name</th>
                          <th>No of Votes</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(candidate, index) in candidates">
                              <td class="text-center">{{ index + 1 }}</td>
                              <td>
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="No Picture" height="50" width="50">
                              </td>
                              <td>{{candidate.name}}</td>
                              <td style="font-weight: bolder; font-family: 'Times New Roman', Times, serif; font-size: 30px;">{{ candidate.no_of_votes }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">S/NO</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>No of Votes</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main row -->
    </div><!-- /.container-fluid -->
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const candidates = ref([]);
const registered_voters_count = ref(0);
const unregistered_voters_count = ref(0);
const votes_count = ref(0);
const voters_count = ref(0);



onMounted(async () => {
    loadData();
    setInterval(loadData, 30000);
});

const loadData = async () => {
    try {
        const response = await axios.get('/admin/voters/streaming_data');
        candidates.value = response.data.candidates;
        registered_voters_count.value = response.data.registered_voters_count;
        unregistered_voters_count.value = response.data.unregistered_voters_count;
        votes_count.value = response.data.votes_count;
        voters_count.value = response.data.voters_count;
    } catch (error) {
        console.error("Error loading data:", error);
    }
};
</script>