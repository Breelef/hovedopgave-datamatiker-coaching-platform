document.addEventListener('DOMContentLoaded', function(){
    const modal = document.getElementById('imageModal');
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');


    function openModal(){
        modal.classList.remove('hidden');
    }
    function closeModal(){
        modal.classList.add('hidden');
    }
    openModalButton.addEventListener('click', openModal);
    openModalButton.addEventListener('touchstart', openModal);

    closeModalButton.addEventListener('click', closeModal);
    closeModalButton.addEventListener('touchstart', closeModal);



    window.addEventListener('click', (e) => {
        if(e.target === modal){
            closeModal();
        }
    });
    window.addEventListener('touchstart', (e) => {
        if(e.target === modal){
            closeModal();
        }
    });

});
