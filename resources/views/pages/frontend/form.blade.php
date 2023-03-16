@extends('layouts.front')
@section('content-app')

    <form id="steps" method="post" class="show-section h-100" novalidate>
        @foreach ($data as $index => $d)
        <!-- step 1 -->
        <section class="steps">
            <div class="step-count">Step {{$index + 1}}/ {{count($data)}}</div>
            <h2 class="main-heading">{{$d->name}} ({{$d->category?->name}})</h2>
            <div class="line-break"></div>

            <!-- form -->
            <fieldset class="form" id="step{{$index+1}}">
                <div class="row justify-content-space-between">
                    <div class="rating">
                        @foreach ($d->question as $question)
                        <h3>{{$question->name}}</h3>
                        <div class="score">
                            <div class="score-inner delay-100ms">
                                <div class="score-point">1</div>
                                <div class="score-point">2</div>
                                <div class="score-point">3</div>
                                <div class="score-point">4</div>
                                <div class="score-point">5</div>
                            </div>
                            <p><span>Sangat tidak setuju</span><span>Sangat Setuju</span></p>
                        </div>
                        <div class="line-break mt-5 mb-5"></div>
                        @endforeach

                    </div>
                </div>
            </fieldset>
            <div class="next-prev-button">
                <button type="button" class="prev">Previous Question</button>
                <button type="button" class="next" id="stepbtn" value="{{$index+1}}">Next Question</button>
            </div>
        </section>
        @endforeach


        <!-- step 2 -->
        <section class="steps">
            <div class="step-count">Question 2 / 4</div>
            <h2 class="main-heading">Probe Deep into the  Respondent's Answers</h2>
            <div class="line-break"></div>

            <!-- form -->
            <fieldset class="form" id="step2">
                <div class="row justify-content-space-between">
                    <div class="focus form-text d-flex">
                        <div class="text-field-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="text-field-input">
                            <input type="text" name="name" id="name" placeholder="What is social name" required>
                        </div>
                    </div>
                    <div class="focus form-text d-flex delay-100ms">
                        <div class="text-field-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="text-field-input">
                            <input type="text" name="mail" id="mail-email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="focus form-text d-flex delay-200ms">
                        <div class="text-field-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text-field-input">
                            <input type="text" name="location" id="location" placeholder="Where you Live" required>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="next-prev-button">
                <button type="button" class="prev">Previous Question</button>
                <button type="button" class="next" id="step2btn">Next Question</button>
            </div>
        </section>

        <!-- step 3 -->
        <section class="steps">
            <div class="step-count">Question 3 / 4</div>
            <h2 class="main-heading">How to be Conversational  in English</h2>
            <div class="line-break"></div>

            <!-- form -->
            <fieldset class="form" id="step3">
                <div class="row justify-content-space-between">
                    <div class="rating">
                        <h3>Rate your Experience</h3>
                        <p>How would you rate Experience with us?</p>
                        <div class="star-rating ">
                            <i class="star fa-regular fa-star"></i>
                            <i class="star fa-regular fa-star"></i>
                            <i class="star fa-regular fa-star"></i>
                            <i class="star fa-regular fa-star"></i>
                            <i class="star fa-regular fa-star"></i>
                        </div>
                        <div class="line-break mt-5 mb-5"></div>
                        <h3>How Sartisfied are you with our product and Services</h3>
                        <div class="score">
                            <div class="score-inner delay-100ms">
                                <div class="score-point">1</div>
                                <div class="score-point">2</div>
                                <div class="score-point">3</div>
                                <div class="score-point">4</div>
                                <div class="score-point">5</div>
                                <div class="score-point">6</div>
                                <div class="score-point">7</div>
                                <div class="score-point">8</div>
                                <div class="score-point">9</div>
                                <div class="score-point">10</div>
                            </div>
                            <p><span>Very Unsatisfied</span><span>Very Satisfied</span></p>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="next-prev-button">
                <button type="button" class="prev">Previous Question</button>
                <button type="button" class="next" id="step3btn">Next Question</button>
            </div>
        </section>

        <!-- step 4 -->
        <section class="steps">
            <div class="step-count">Question 4 / 4</div>
            <h2 class="main-heading">How you Contact to our  Company</h2>
            <div class="line-break"></div>

            <!-- form -->
            <fieldset class="form" id="step3">
                <div class="row justify-content-space-between">
                    <h3 class="sub-heading">Where you Get From</h3>
                    <div class="select">
                        <div class="select-inner">
                            <span><i class="fa-solid fa-hashtag"></i>Select Platform</span>
                            <i class="select-icon fa-solid fa-sort-down"></i>
                        </div>
                        <ul class="select-menu">
                            <li id="facebook"><i class="fa-brands fa-facebook-f"></i>Facebook</li>
                            <li id="Instagram"><i class="fa-brands fa-instagram"></i>Instagram</li>
                        </ul>
                    </div>
                    <div class="line-break  mt-5 mb-5"></div>
                    <h3 class="sub-heading">Do you have any suggestions how to improve.</h3>
                    <textarea class="textarea delay-100ms"></textarea>
                </div>
            </fieldset>
            <div class="next-prev-button">
                <button type="button" class="prev">Previous Question</button>
                <button id="sub" type="button" class="apply">Submit</button>
            </div>
        </section>
    </form>
@endsection
