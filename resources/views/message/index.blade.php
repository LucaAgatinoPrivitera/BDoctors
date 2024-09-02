@extends('layouts.app') 

@section('content')  


<div>

    <div>
        <div class="p-5 mb-4 rounded-3">
            <div class="container py-5">
                <h1 class="display-5 fw-bold">Invia un Email</h1>
                <p class="col-md-8 fs-4">
                    Using a series of utilities, you can create this jumbotron, just
                    like the one in previous versions of Bootstrap. Check out the
                    examples below for how you can remix and restyle it to your liking.
                </p>
            </div>
        </div>
    </div>

    <div class="container pb-5">

        <form>
            <form class="d-flex">
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">Type your name</label>
                        <input type="text" name="" id="" class="form-control" placeholder="Name"
                            aria-describedby="helpId" />
                        <small id="helpId" class="text-muted">Name</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Type your Email</label>
                    <input type="email" class="form-control" name="" id="" aria-describedby="emailHelpId"
                        placeholder="abc@mail.com" />
                    <small id="emailHelpId" class="form-text text-muted">Email</small>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Message</label>
                    <textarea class="form-control" name="" id="" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    Send message
                </button>
            </form>
        </form>
    </div>
</div>
