<template>
    <div>
    	<div class="columns">
    		<div class="column is-quarter">
    			<div class="field has-addons">
    			  	<p class="control has-icons-left is-expanded">
    			    	<input class="input is-medium" type="text" placeholder="Search Users" v-model="searchUsers">
    			    	<span class="icon is-small is-left">
			    	      	<i class="fa fa-search"></i>
			    	    </span>
    			  	</p>
    			</div>
    		</div>

    		<div class="column">
    			<button class="button is-primary is-medium" @click="showAddModal">
    				<span class="icon">
				     	<i class="fa fa-plus"></i>
				   	</span>
    				<span>Add User</span>
    			</button>
    		</div>
    	</div>
    	
    	<users-list :users="filteredUsers" />

        <user-modal></user-modal>
    </div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	import { UsersList, UserModal } from '../../components/users'

    export default {
    	mounted () {
    		this.fetchUsers()
    	},

    	data () {
    		return {
    			searchUsers: '',
    		}
    	},

    	computed: {
    		...mapGetters({
    			users: 'users/users',
    		}),

    		filteredUsers () {
    			return this.users.filter((user) => {
    				return user.full_name.toLowerCase().indexOf(this.searchUsers.toLowerCase()) !== -1
    			})
    		}
    	},

    	methods: {
    		...mapActions({
    			fetchUsers: 'users/fetchUsers',
    		}),

            showAddModal () {
                Events.$emit('user-modal', true)
            }
    	}
    }
</script>