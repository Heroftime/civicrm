<div>

    {if count($data) gt 0}
        <table>

            <tr>
                <td>Title</td>
                <td>Status</td>
                <td>Contribution/Event</td>
                <td>No# of Contributions</td>
                <td>Amounts raised</td>
                <td>Target amount</td>
                <td>Edit Page</td>
            </tr>


            {foreach from=$data item=val}
                <tr>
                    <td><a href="{$base_url}/civicrm/pcp/info?reset=1&id={$val.id}">{$val.title}</a></td>
                    <td>{if $val.status_id eq 1}Waiting Review{elseif $val.status_id eq 2}Approved{elseif $val.status_id eq 3}Not Approved{/if}</td>
                    <td>{$val.cp_title}</td>
                    <td>{$val.no_of_contributions}</td>
                    <td>{if $val.amount_raised}{$val.currency}&nbsp;{$val.amount_raised}{else}0{/if}</td>
                    <td>{$val.currency}&nbsp;{$val.goal_amount}</td>
                    <td><a href="{$base_url}/civicrm/pcp/info?action=update&reset=1&id={$val.id}">Edit</a></td>
                </tr>
            {/foreach}

        </table>
    {else}
        <div>No Pesonal Campaign Pages yet!</div>
    {/if}

</div>
