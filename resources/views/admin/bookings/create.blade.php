@extends('admin.layout.base')

@section('title')
    | Discount lucky
@endsection

@section('content-header')
    <h3>
        Discount lucky
    </h3>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div id="app" class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5><i class="far fa-tags"></i> 20% discount</h5>
                    <h3>List of winners:</h3>
                    <ul>
                        <li v-for="(winner, index) in winners" :key="index">@{{ winner.name }}</li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Make a luck for discounts <i class="far fa-tags"></i></h1>
                </div>
                <div class="card-body" style="height: 200px;">
                    <div v-if="picked"
                        style="background: url('https://www.icegif.com/wp-content/uploads/2023/02/icegif-1166.gif'); height: 200px;">
                        <p class="text-center"><i class="far fa-party-horn"></i> Congratulations</p>
                        <h1 class="text-center animated bounceIn">@{{ pickedName.name }}</h1>
                    </div>
                    <div v-if="shuffling" class="animated fadeIn">
                        <p class="text-center">Shuffling Names...</p>
                        <h1 class="text-center" v-if="displayedNames.length > 0">@{{ displayedNames[0].name }}</h1>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100" @click="startPicking" :disabled="picking"><span
                            v-if="picked">Pick again</span> <span v-else>Start Picking</span></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                users: @json($users),
                picking: false,
                picked: false,
                pickedName: null,
                shuffling: false,
                displayedNames: [],
                winners: [],
            },
            methods: {
                startPicking() {
                    this.picking = true;
                    this.picked = false;
                    this.pickedName = null;

                    this.shuffling = true;
                    this.displayedNames = this.shuffleArray([...this.users]);

                    const startTime = Date.now();
                    const shuffleDuration =
                        10000;

                    const displayInterval = setInterval(() => {
                        const elapsedTime = Date.now() - startTime;

                        if (elapsedTime < shuffleDuration) {

                            this.displayedNames = this.shuffleArray([...this.users]);
                        } else {
                            clearInterval(displayInterval);
                            setTimeout(() => this.pickRandomName(), 50);
                        }
                    }, 100);
                },
                pickRandomName() {
                    const randomIndex = Math.floor(Math.random() * this.users.length);
                    const winner = this.users[randomIndex];
                    this.pickedName = this.users[randomIndex];
                    this.pickedName = winner;
                    this.picking = false;
                    this.picked = true;
                    this.shuffling = false;

                    this.winners.push(winner);
                },
                shuffleArray(array) {
                    let currentIndex = array.length,
                        randomIndex;
                    while (currentIndex !== 0) {
                        randomIndex = Math.floor(Math.random() * currentIndex);
                        currentIndex--;
                        [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
                    }
                    return array;
                }
            }
        });
    </script>
@endsection
