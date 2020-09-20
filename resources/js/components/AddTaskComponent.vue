<template> <!--TEMPLATE DU MODAL D'AJOUT DE TÂCHES -->
    <div>
                <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark my-3" data-toggle="modal" @click="getUserId();" data-target="#exampleModal">
        Ajouter une tâche
        </button>
                <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une tâche</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Nom de la tâche</label>
                                <textarea name="name" id="name" rows="5" class="form-control" v-model="name"></textarea>
                            </div> 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success" @click="taskStore()" data-dismiss="modal">Créer ma tâche</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default 
{
    data(){
        return{
            
            UserId: '',
            name: ''
        }
    },

    methods: 
    {
        // méthode getuserId qui récupère l'userid
        getUserId()
        {
            axios.get('https://lepetitbloc.dev/user')
            .then(response => this.UserId = response.data)
            .catch(error => console.log(error));
        },

        taskStore(){
            axios.post('https://lepetitbloc.dev/tasksList', 
            {
                // méthode taskStore qui va post à la route en récupérant la tâche + l'user id

                user_id: this.UserId,
                name: this.name
                
            })
            .then(response => this.$emit('task-added', response))
            .catch(error => console.log(error));
        },
    },
}
</script>