
{assign var=errors value=$flashBag->get('error')}
{assign var=successes value=$flashBag->get('success')}

{foreach $errors as $error}
    <strong class="alert alert-danger alert-dismissable text-center display-block">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
        {$error}
    </strong>
{/foreach}
{foreach $successes as $success}
    <strong class="alert alert-success alert-dismissable text-center display-block">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
        {$success}
    </strong>
{/foreach}
