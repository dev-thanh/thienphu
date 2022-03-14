<section class="form__register">
    <div class="container">
        <h2 class="title__global">
            {{@$content->contact->title}}
        </h2>
        <div class="desc__global">
            {{@$content->contact->desc}}
        </div>
        <form action="{{route('home.post-contact')}}" class="form__register-global" method="POST">
            @csrf
            <div class="form__box">
                <input type="text" placeholder="Họ và tên" class="input__control" name="name">
                <span class="fr-error fr-error_name"></span>
            </div>
            <div class="form__box">
                <input type="text" placeholder="Số điện thoại" class="input__control" name="phone">
                <span class="fr-error fr-error_phone"></span>
            </div>
            <div class="form__box">
                <input type="text" placeholder="Email" class="input__control" name="email">
                <span class="fr-error fr-error_email"></span>
            </div>
            <div class="form__box">
                <input type="text" placeholder="Tiêu đề" class="input__control" name="title">
                <span class="fr-error fr-error_title"></span>
            </div>
            <div class="form__box textarea">
                <textarea placeholder="Lời nhắn" class="input__control" name="content"></textarea>
                <span class="fr-error fr-error_content"></span>
            </div>
            <button type="button" class="btn btn__register btn__send__contact">
                Đăng ký
            </button>
        </form>
    </div>
</section>