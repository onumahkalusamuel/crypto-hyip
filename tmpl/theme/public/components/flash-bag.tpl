{assign var=errors value=$flashBag->get('error')}
{assign var=successes value=$flashBag->get('success')}

{foreach $errors as $error}
    <div class="alert alert-danger alert-dismissible" role="alert" style="font-weight: bolder;">
        {$error}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
{/foreach}
{foreach $successes as $success}
    <div class="alert alert-success alert-dismissible" role="alert" style="font-weight: bolder;">
        {$success}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
{/foreach}