import swal from 'sweetalert'

export default function confirmDelete(name) {
    return new Promise((resolve, reject) => {
        swal({
                title: "Warning",
                text: `Are you you would like to delete "${name}"?`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3860",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    resolve();
                }
            });
    })
}