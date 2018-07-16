{% if type == 'head' %}
<div class="page-header">
    <h1>Dump Pack's <small>admin panel</small></h1>
</div>
</div>
</div>

<div id="pricing_table_example2" class="row">
    {% elseif type == 'pack' %}
    <div class="col-md-4">
        <div class="pricing-table" style="margin:10px; {% if dumpcount < packs.value %} background: rgba(239, 25, 25, 0.5); {% endif %}">
            <div class="top">
                <h2>{{packs.name}}</h2>
            </div>
            <ul>
                <li>
                    <strong>{{packs.value}}</strong> Dumps
                </li>
                <li>
                    <strong>
                        {% if packs.country == '0' %}
                        Mix Country
                        {% else %}
                        {{packs.country}}
                        {% endif %}
                    </strong>
                </li>
                <div class="well">
                    <table style="width:100%">
                        <tbody>
                        <tr>
                            <td>
                                <h4 class="text-success">Type:
                                    <b>
                                        {% if packs.type == '0' %}
                                        All
                                        {% else %}
                                        {{packs.type}}
                                        {% endif %}
                                    </b>
                                </h4>
                            </td>
                            <td>
                                <h4 class="text-warning">Code:
                                    <b>
                                        {% if packs.code == '0' %}
                                        All
                                        {% else %}
                                        {{packs.code}}
                                        {% endif %}
                                    </b>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="text-info">Class:
                                    <b>
                                        {% if packs.class == '0' %}
                                        All
                                        {% else %}
                                        {{packs.class}}
                                        {% endif %}
                                    </b>
                                </h4>
                            </td>
                            <td>
                                <h4 class="text-primary">Level:
                                    <b>
                                        {% if packs.level == '0' %}
                                        All
                                        {% else %}
                                        {{packs.level}}
                                        {% endif %}
                                    </b>
                                </h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </ul>
            {% if packs.comment1|length>0 %}
            <div style="margin-left:20px; margin-right:20px" class="alert alert-success">
                <center>
                    <strong>{{packs.comment1}}</strong>
                </center>
            </div>
            {% endif %}
            {% if packs.comment2|length>0 %}
            <div style="margin-left:20px; margin-right:20px" class="alert alert-info">
                <center>
                    <strong>{{packs.comment2}}</strong>
                </center>
            </div>
            {% endif %}
            <hr>
            <h1>
                <sup>$</sup>{{packs.price}}
            </h1>
            <p>
                {% if dumpcount < packs.value %}
                {% if dumpcount == '0' %}
                <span type="button" class="btn btn-default btn-squared">No dumps</span>
                {% else %}
                <span type="button" class="btn btn-default btn-squared">Only {{dumpcount}} dumps</span>
                {% endif %}
                {% endif %}
            </p>
            <a href="#" onclick="showpage('packs.php?act=edit&id={{packs.Id}}');" class="btn btn-warning">
                Edit
            </a>
            <a href="#" onclick="if (confirm('Are you sure?')) {showpage('packs.php?act=delete&id={{packs.Id}}');}" class="btn btn-bricky">
                Delete
            </a>
        </div>
    </div>
    {% elseif type == 'footer' %}
</div>
<div>
    <a href="#" style="margin-top:20px" class="btn btn-green btn-lg btn-block" onclick="showpage('packs.php?act=create');">Create Pack</a>
    <p></p>
</div>
{% endif %}