
{assign var=errors value=$flashBag->get('error')}
{assign var=successes value=$flashBag->get('success')}

{foreach $errors as $error}
    <strong class="alert alert-danger" style="display:block;min-height:25px;">
        <button style="background-color: white; border-color:brown;float:right; cursor:pointer" onclick="closeAlert()"> × </button>
        {$error}
    </strong>
{/foreach}
{foreach $successes as $success}
    <strong class="alert alert-success" style="display:block;min-height:25px;">
        <button style="background-color: white; border-color:darkgreen;float:right; cursor:pointer" onclick="closeAlert()"> × </button>
        {$success}
    </strong>
{/foreach}
