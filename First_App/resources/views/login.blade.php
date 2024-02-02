@extends('app')

@if (session('failed'))
    <div class="alert alert-danger" id="successAlert" role="alert" style="position:absolute;top:80;right:50">
        {{ session('failed') }}
    </div>
    <script>
        // Automatically hide the success alert after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);
    </script>
@endif

@section('register')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="vh-100" style="background-color: #503C3C;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form action="/login" method="POST">

                                    <div class="d-flex align-items-center mb-3 pb-1" style="justify-content:center">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">
                                            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBIVEhYSEhQYGBgYHR0ZEhkSHBYYGRgZGhgZHBoeGBkcJTwmHB44HxgZJjonKzAxNTU1GiQ7QDszPy42NjEBDAwMBgYGEAYGEDEdFh0xMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMf/AABEIAOAA4QMBIgACEQEDEQH/xAAcAAEAAgIDAQAAAAAAAAAAAAAABgcEBQECAwj/xABJEAACAgECAwUDCAQLBgcAAAABAgADBAUREiExBhNBUWEiMnEHFCNCUmJygVOCkaEVFiQzRHOSsbLBwoOTorPR0jQ1NkNktPD/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AuaIiAiIgIiICIiAia7VtYx8ZQ2Raqb8lB5sx8kQe059FBM1L61m2gtjYwpr699qJNY281pX2z+sUgSVhMXLz6alJutrrHnYyoP8AiMrzVNew13GXql+Q3jVp/wBDXuPDjr5/tskebtngVtxYulV8X6TKIZ/zOzE/2oFmN2z07nw5KWbdRQHuP7K1M6/xxxT7teUw80xMrb96SsLvlN1E8kFFY8BXWTt/aYj90w7PlB1U/wBJI/ClI/0wLb/jljj3qcxfxYmV/wBk7fxz0/q95r9b67qR+2xBKgTt/qo/pRPxSn/smZT8pupr7zVOPHjrH+giBc+BrGLeN6L6rP6t1b9wM2Eo49u8e4/yzTMaz76AK49RxKTv+sJudM7Raa23zfNy8FvBLWN1PwIfjVR8CsC2IkTxtVz1QPw051XhZhMqWbefduxRj8HHwm00vtDjZDGtHK2D3qblau1fjW4BI9RuPWBuIiICIiAiIgIiICIiAiIgIiICImn1nW0o4a1Rrb7NxRTVtxvt1JJ5Ig8WPIfHlAz83NrpRrbnVEUbszkBR+ZkYy9Zyb0NlbDCxRzbJygBa6+dNT8lB8Gfn5KZoO0Os1YrrdnsuVmD2qMas/yfF36HY9W++wLHwCiVvr2v5OZZ3mS5bb3EHJE/Anh8TufWBL83tpiYzMdOpN1x5Pl5nE1jfh4va29PZX0kN1fXMrKbiybnfyUnZB8EHsj9k18QEREBERAREQEREDJwM+6h+8osetvOtiu/xA5MPQ7yY4nbxLlWrVcdb1HuW1gJch+0uxGx9UKn4yCxAvLR9TuCd7h3fwhjD3kchcurx2DHYWfhfhb7xkm0nWKMlC1L78J4bFYFXrbxWxDzVvQifOGn59tFgtodkcdGQ7cvIjow9DyliaL2oozXQ3OMTOUBasqrYJb5Jap5MpP1G5fZIMC3Yke0nXHNnzTMQVZGxKcJJqyFHVqGPX1Q+0u/iOckMBERAREQEREBERARE1Gv6uMeoFV47bDwY1QOxssPQb+CjmWbwAJgeWvay1RXHx0FmVaD3NZOyqo96y0j3ax59SdgOZle9o+0i4PeU41nfZ1nLMymA9g/YrHRQOgQcl8d23nPanXTgrZRXZ3mfeA2dkLy7sEeylf2QAdlXwHtHmZWRgc2OWJZiWZiSxYkkk9SSepnERAREQEREBERAREQEREBERAQREQJv2a7WI9a4Op7vTuO5u3Isx3HuMHHMAeDDmvqOlnaRqlldi4eYwZmG+JkDYLkoBvsduS2gcyo5Ecxy3A+epNux3aFHT+Dc5j3DkfNrN9mx7Ad1Kt1UcWxB+qfQ8gvSJHuz+p28TYeWR84qG4YclyKt9ltQeB8GX6rehEkMBERAREQEREDxyL0rRrHYKqgs7HkFUDckny2ErnV9eNFTapav094NemVOP5qk8+Nh4Mw4Xb9RZIe0Vi5GQuCSBTWoyNQY9O7Uk11N6Mylj91D5ym+12vNm5b3HcIPYoU/VrB5cvAn3j8dvCBp7rWdmd2LMxLOzcyzE7kk+e86REBERAREQEREBERAREQEREBERAREQEERECzOyGrvmULj8YGdie3g2Of5xANmrc+Kkew3oVbqsszQ9UXJoW5QVJ3WxG96t1Ozo33gwInzhp+a9FqX1NwujBkPqPA+YI3BHkTLn0rVkF1OdVyx8/hS9eX0WWBwox8uLhNZPiyp5wJ1ERAREQExc/MSmp7bDslas7nyVQSf7pkbiRvtZ9M2Lg+F9nFcB+go2dwfQt3aH0cwIH2uz7KNPCPyydRc35Q8Uq5cNfwC8Cfk3nK3kg7c6v85z7rAd0U93V5cCEjcfFuJv1pH4CIiAiIgIiICIiAiIgIiICIiAiIgIiIAwIMCAk4+TrLS0X6Vc2yZKlqTvzruUbgr5NsoYetY85B57YOW9NqXJ76Mrp8VO+3wPT84H0T2Y1B78ZWtG1qFqskDwtrPC+3oSOIejCbcGRbSMtFzu8Q/RZ9K5Ffl3taqr/ma2rP+zMlJgekTrtEDqBIRrOo8FmpZgP/AIalcan0tcCxtv1rKR+rJwBKe7W5Z/ghW6nMy7bSfNA9hT/hSqBXAE5iICIiAiIgIiICIiAiP/3KSLUNFqSlq6yTlYyizMG+6lH95UH2q96w23Xjf7PII7E3eh4ONwPfmllqZu4qKbg942xaz1REPER0JZR6TWZ2I9Nr02DZ0Yq23MHboVPipGxB8QRAx4iICIiAiIgIiICIiBZvZfUOLS6Lur6fkqT59zYeF/yCXP8A7uW2BKP+TVRaufhN0vx24R95d13Hr9IP2S2+zWcbsPGuPV6kZvxFBxb+u+8DbxOJzAwdUv4KLX+wjt/ZQn/KUz2+U14mlY/2Mfib8RWob/tDS2e2HLTc0+WNf/ynlU/KtyvxU+zjJ/if/pAg0RtEBERAREQEREBET1xcayyxKq14ndglajxZjsPgPM+AgbXQUWpXzrACKSFx1bmHyWG9Y28VQAufwqPGeGgWXHMqar27HfnxnlYH37zvD9goX4j5bmemvXrxJjUktTjgojAHaxyd7bf1mHL7qpPWhTjYhs2IuygyV8jumMDtY/oXYcA+6rkdYHftgqLbWlG3zVax8yKkkMjEmxiT1c2Bw2/P2V9J55H8pxBZ1txQqW+b45PDW/qUY8B+6yE9JzpKHIpfCIPGvFbh8vrgfSVD0dV3A+2g+1MDSc1qLVtC8a81sQg7WVuOF0b0Kkj0Ox8IGFEz9Z08UWlEJatgLMdz9ep+aE/e6qR4MrTAgIiICIiAMRG0DrO0RAlnyXZHDqlI+2rof7BcfvQS2ew5/kYr/R25FQ+CZFir+4CU12BbbVMT8ZH7a3EujseNlyx5ZeRt+bhv9UCQ7ROYgaXtgu+m5o88e7/lPKp+VXnfiv8Aaxk/xP8A9Zcup08dFtf20df7Skf5yl+3pNmJpWR9vH4W/EFqO37S0CEREQEyMDEe61Ka9uOxlROMkLxMdhxEA7Dc+Ux5t+yX/mGJ/XV/4xA3tnyY6kqlmONsoJP0lnQDc7exNB2f7PZWaxXGr4gu3E7nhRd+nE3n6Dc+km/yiY2ni/JsObauUFUigbiviFaBRvw+K7H3upnSy58fs1U2OxRrrCLnQ7Nsz2A+0OY5Iib+UDQaz2BzsWhsi00FE24+7d2YcTBRyZB4keMwez/ZTMzQzY6LwKdi9p4U38gdiSfgDt47TTfOrFRwruAw9tQzbONwdmHjzAPPylj/ACiXNjYOBh0MVqZCbChI4yqp7xHUEuzEeJIgRvWuwuoYtZusRHRebtQxfgHmwZQdvUAgeO0xuzPZ/Nye8tw2CvRsSQ71vuytsKyo6kBh1HX1kl+SHPs+dPiFi1L1M7I25VWVkG4B5DcOQfPceU2Hyc3rjLq7ovEtBLIu/vLUcjhG/qFHP1gQ3RsrVMq9cenLyS7b+/kZChQo3Jc8W6jw6dSBMy2nV1zRp5zbu+YgDbJyODcpxj2uvu+nWWFj2YONamfjbM+pWVLUD0VXZTaQB7vizfe4RI/n/wDqpPxJ/wDWMCI63lapiXNj5GXkh1APsZF7KwYbgqeIbjqOnUGZuvYus4dVd2TmXqth2RVychnU8PFs43AB25ciecsfURgZWQ9+QQr6ZYxtB22ZODjQt5rxbMPvIw8ZF/lO1H5xpuDk8PD3rlgvkGrYgH122gaxuwOr5KpdZbXZxKpRr77nYKw4gN2Q7deg8SZpcHsll25duDWau9qBLlmcJy4QeFgm598eA8ZYXajFwHx8D57l2Y5FI7sVAnjBSvi4tkPTZfLqZH/kiI/hK3Ziw7p9mPUjvK9ify2ganVPk91GiprmWp1UEt3DszKo6nhZRuB6bmajQez+VmuUxk4uHbjZjwom/Tib/Ibn0lh6TpyaVjZea2Qt6WDgRMcE18bMwHGwJG/EQpPLbn13AmvqtfH7Mo+OxRrrCtzpybY2Oh9ocweGtU39YGi1jsBn41D5FpoKJsX7t3ZgCQOjIPE+c50r5PtQyKUyKu44LF4l43dW2+8Ah2P5mRhMmxQwDuA42sAZtmHXZh9bmB1lrWY2G+i4AzMh8dBsUaoElm4X9k7KeW25/KBWuuaRbiXNj38HGoUnu2LLsw3HMgHp6TXzJ1Naxc61OzoGIrd9+J0B9kncDw9BMaAiIgSHsCu+p4n4yf2VuZc/ZDmuU3nl5G35Pw/6ZUvyW4/FqlJ/RrY5/sFP73EtnsKN8IWfpLL7R8LMixl/cRAkcREBKc7W4hOkcHjh5dlZ9EZ3CD4cNlUuOQXWNO47tRwx/S6FyKf62sCttvzSg/nAo+IEQEz9By0py8e59+CuxHfhG54VYE7DxPKYEQLG1fV+z+Tc+RdXkmx9uIrxKPZVVHINsOSiarsl2spqxnwM+o24zEkcHNkJO5G24JHF7QIO4O/Xwh0QJlq+VoSUWLhVWvdYvCjW8fDXuRuQHPXbyBPqJk6T2tw7cRMHVaXsSvbuba9yyhRsu+xDAgctxvuOo84JECfv2p07CqsTSKn720cLX3cW6D7oY7kjwGwG/M77bTVdk+0FOPi59NvFx5NfBVwjiHFwWr7Z35c3Xn8ZFYgbLRdR7vIxnsZjXRYrhRz4V41d+BfMkb+pkgyu02O2tpqA4+5DKTuvtcqeA+zv9r1kNiBuO0erC7LybqWcV3sNwfZLKAhAdfxID+U2XaHXqL9MwsSvj46AO84l2X3CvsnfnzMisQLKz+0ei5NOMmWuQzUIEHACo3KoG91ufNBNV2W1/Bw9SuvRbBjMhSkbcT7k1k8W581bx8pCogTHst2kx66MvDzA5ov3avu14mR25Egb8uiMPIr6x2S7V00UWYOdWbsZySOEe0pO2/s7g8JIDcjup36+EOiBM9WytCSixcOq57rEKI1vecNZb62znr8AT6ibDG7RaTZp+NiZqXsaAD9GCo49mHJgw3GzGV5EDZa+2IbycJXWnhXhFu5bi+t1J5TWxEBERAnPybEUpn5zdKMdgp+83E2w9fYUfnLd7N4XcYePQeqVIrfiCDi/fvK47L6eV0vGo6PqGSpbz7ms8b/kUoP+8ltwEREBIz2t+iONnj+j2bXH/wCPd7Fu/oCUf/ZyTTHzMVLa3qsHEjqyOD4qwII/YYHz/wBvdI+bahdWBsjnvavLhckkD4NxD8hI7LM7Waa9+n7v7WTpzGq8+L07Ao/qCndvv6NKzgIiICIiAiIgIiICIiAiN4gIiICIiAiIgIiICZGn4b3210J79jqi+hY7b/ADc/lMeTn5O8RaUyNVtXdaFKY6+L3NsAF829pUHrZ6QLF0jGRs4rWPosCpcary71wjWfmEWofrtJZNR2Z05qMZUsO9rE2ZDfatsPFYfhudh6ATbwEREBERAivaRBj3Jn7b1Mox9QXbcGlieCwj7jMd/uu3lKc7YaAcLKaoc629vHbrxITyG/iR7p+APjPoi6pXVkYBlYEMDzBBGxBHltK61bQO9rOk2t9JWDZpNzn36x1qc+LKNlPmvC3UGBT8T0yKHR2rsUq6Eq6tyKsDsQZ5wEREBERAGBBiAiN4gIiICIiAiIgIiICIgmBk6bgWZFyUVDd3YKvkPMn0A3J9BLp0jTK2uqw6uePp+zWN4W5ZG4B8+EMXP3nT7MjnZPR7MKlLQoOfmDgxK2H8zXyL2WDwAGzN+ovUyytE0xMahaEJbh3LM3vO7Hd3Y+LFiSfjA2MREBERA4M6rO8QE1WvaSuTVwcRSxSHx7F96q1fdYeY8COhBI8ZtYgVL2n0Js9XsWsJqGOAMulel6D3XrJ94EDdT8VPMCVeR4EbEciDyII6gjwM+j9d0bvuC2lu6yatzRbtuOfVLB9atvFfzGxEr/tF2cXPL2VVijPrG+VjMQFtHQPW3RgduT9D0bYwKwid7qmRmR1Ksp2dWBDKR1BB6GdICIiAnWdjEBERAREQEREBERAREGAk67Hdn66q11LOUlAR80pA3fIsJ+j4U+tz90ePU8hz57N9lK6q1zdSVghIGNjAE25Dnmo7vqd/BPHqdgOdlaPpNr2jNzQBaARj0jYpioeoB6NaR7z/AJDl1D10DS7FZsvK2OTcAGC81prHNaUPkN9yfrNufKb1Z3iAiIgIiICIiAiIgJqNa0WvICsS1dqbmi6vYPWT5HoVPip3BHWbeIFZdotJryGFOpKuPkn2cfMrH0GR9lX391vuMfwsZXPaDs3lYT8GQmyk7JYm5rf4N4H0Oxn0Xl4qWo1dqK6MNnVwGUjyIPWRm/Q8ihGTG4cnHPJsTLO5VfKi1t+Xkj7jyZYFBxLFzux+FkuUw7Gxcjq2JmAqd/uE7kr6qXX4SH6z2dy8Un5xQ6L9sDirP668h+exgaoxEQOs7REBERAREQETL03S8jJbgx6XsPj3Y3A/E3ur+ZEmWJ2Fpo4X1TIVC3uY+Pu9zn7I4QST6ID8RAhul6Zfk2CrHrZ3PgvRR5sx5KPUyxtE7NUYViqyDNz9gyU1/wA1j79Gtc8lH3mG5+qskmmaXkMgqxqv4OxvHh4Wy7fUnmtXLxJZvwyS6VpVGMnd0IEBO7HmWdj1Z2PNmPmSTAwNI0Nls+dZTi7JI2DbbV0qeqUKfdXzY+03ifAb+IgIiICIiAiIgIiICIiAiIgIicEwMHU9Mx8hODIqSxeoDjcg+anqp9RsZpzoWVSP5Jllk/Q5wN6beS2bixfzLfCSYCcwK11TQ6HJObpDo3U3aawsUnzKJwufzQyN3dktMc7UamKmPRM5eBvhs/Af3GXdPDIx0ccLorDycBh+wwKUf5Mcw86bsa0eBR2B/Zw7fvmK/wAm2qD/ANlG/DZX/mRLdt7H6ax3+Z0qT1NahD+1NjPM9jML6ouX0TIylH7ngVIvycaqf6Oo+NlX+TTKr+THUOtjY9Y8S9jf6Vlojsbh+JyG/Fk5R/vsnYdi9N6ti1v/AFvFZ/jJgVgOxeDWeHK1WkN+jxwrOfQDiJJ/Vm90zs/gLt8103Kym8HzB3FXxIt4dx8EaWRiafTUNqakQeVaqv8AcJlEQIvRpOe6hbL68Wv9Fp6jiA8jc45fqoPjNnpOgY2OS1VY429+xy1lrfisYlj8N9ptAfCdoCIiAiIgIiICIiAiIgf/2Q==" alt="">
                                        </span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                        account</h5>

                                    <div class="form-outline mb-4">
                                        <input name="login_email" type="email"
                                            class="form-control @error('login_email') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('login_email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        <label class="form-label" for="form2Example17">Email address</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input name="login_password" type="password"
                                            class="form-control @error('login_password') is-invalid @enderror "
                                            id="validationServer03">
                                            @error('login_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label class="form-label" for="form2Example27">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block"
                                                type="submit">Login</button>
                                        </div>

                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
