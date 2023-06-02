@extends('front.layouts.app')

@section('title', 'About')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="aboutSec aboutInner">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <div class="aboutContent">
                        <h2 class="secHeading">About Me</h2>
                        <p data-aos="fade-right" data-aos-duration="2000">I migrated to this country from Haiti at a
                            young age. As a child, I grew up watching the women in the family take care of people so
                            naturally that’s what I wanted to do. My 1st career was in the social service field, after
                            receiving my 1st. Bachelor’s degree in psychology and sociology. As a Social worker, I
                            enjoyed advocating for inner city families while connecting them to various services. Along
                            the way I was able to rise up in leadership in my church where I was ordained as a minister.
                            As a minister I got to support people of all ages with spiritual and life counseling as well
                            as mentorship. As I entered my 30s, the medical field called out to me, hence receiving my
                            second bachelor’s degree in the field of Nursing. As a nurse I worked with various age
                            groups in various settings.</p>
                        <p data-aos="fade-right" data-aos-duration="2000">Starting with my nurse mentorship at the Brigham and Women’s hospital in Boston, then on a
                            head injury unit at the Braintree rehabilitation </p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <div class="aboutImgs">
                        <img src="{{asset('images/abt1.webp')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="aboutContent" data-aos="fade-up" data-aos-duration="2000">
                        <p>hospital, then back to Boston working on the pediatric oncology unit at the Children’s
                            hospital as well as working with the elderly and physically impaired patients at different
                            nursing and rehabilitations centers. Years later, I became disillusioned with the healthcare
                            system as it was. I walked away and started my own health and wellness coaching business
                            through Herbalife international. This allowed me the freedom to indulge in what I love,
                            which is to listen to people and provide great individualized and creative care plans to my
                            clients. It was gratifying to see the impact of empowering someone to change their lifestyle
                            for the better. But that was short lived due to life circumstances at that time.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-3">
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/abt22.webp')}}" class="img-fluid" alt="">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="aboutContent" data-aos="fade-right" data-aos-duration="2000">
                        <p> I then returned to nursing, this time I wanted to be more immersed in the community. I
                            worked as a hospice nurse with Care Dimensions. Working with communities along the eastern
                            side of Massachusetts, I was able to educate medical staff as well as patients about end of
                            life care and services. It was an honor and privilege to bring a level of comfort and peace
                            of mind to these patients and their family as they faced the inevitable. Now working as a
                            community nurse with the Behavioral health community partner’s program- a state funded
                            program. I have the honor of providing care coordination for my clients. What this means is
                            I get to listen to my clients’ questions and concerns as well create personalized plans with
                            them to achieve their care goals. Also, I am a state certified Medication Administration
                            program instructor-I teach and certify Non-medically trained people on how to administer
                            medication appropriately. Thus far in my life as a career woman, I recognized that my
                            strengths are that I’m a great listener, counselor/mentor and educator. With my education
                            and life experiences I more than ever want to help people in a personalized way. </p>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="aboutContent" data-aos="fade-up" data-aos-duration="2000">
                        <p>My passion is to mentor and educate people into living a healthy life. Practically, together
                            with you I will create an individualized health plan to address your health concerns,
                            educate you with disease prevention information including lifestyle changing techniques, and
                            mentorship for good health maintenance. I look forward to assist you in your journey to good
                            health.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
