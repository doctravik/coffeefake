<div class="modal {{ session('congratulations') ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <article class="media">
                <figure class="media-left">
                    <p class="image is-64x64">
                        <img src="{{ Storage::url('images/smile_64.png') }}">
                    </p>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>Congratulations!</strong>
                            <br>
                            Your order was successfully proceeded! But it is only joke!
                            You should understand that there is no coffee without money. 
                            Don't upset. You have got new experience :)  
                        </p>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <button class="modal-close"></button>
</div>