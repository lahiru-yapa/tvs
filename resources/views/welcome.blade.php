<!DOCTYPE html>
<html lang="en">

<!-- //header -->
@include('includes.header')

<body>
    <!--== MAIN CONTRAINER ==-->
    @include('includes.topBar')

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
         <!-- //side bar -->
         @include('includes.sidebar')
            <!--== BODY INNER CONTAINER ==-->
            <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
                        </li>
                        <li class="active-bre"><a href="#"> Dashboard</a>
                        </li>
                       
                    </ul>
                </div>
               
            </div>

        </div>
    </div>

  
    @include('includes.js')
</body>

</html>