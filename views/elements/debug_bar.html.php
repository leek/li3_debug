<div id="sfMiniToolbar" class="sf-minitoolbar">
    <a href="javascript:void(0);" title="Show Symfony toolbar" onclick="
        var elem = this.parentNode;
        if (elem.style.display == 'none') {
            document.getElementById('sfToolbarMainContent').style.display = 'none';
            document.getElementById('sfToolbarClearer').style.display = 'none';
            elem.style.display = 'block';
        } else {
            document.getElementById('sfToolbarMainContent').style.display = 'block';
            document.getElementById('sfToolbarClearer').style.display = 'block';
            elem.style.display = 'none'
        }

        Sfjs.setPreference('toolbar/displayState', 'block');
    ">
        <img width="26" height="28" alt="Lithium" src="data:image/png;base64,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">
    </a>
</div>

<div id="sfToolbarClearer" style="clear: both; height: 38px; display: block;"></div>

<div id="sfToolbarMainContent" class="sf-toolbarreset">
    <!-- Config -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <span>
                <a href="http://lithify.me/">
                    <img width="26" height="28" alt="Lithium" src="data:image/png;base64,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">
                </a>
            </span>
        </div>
        <div class="sf-toolbar-info">
            <div class="sf-toolbar-info-piece">
                <div class="sf-toolbar-info-piece">
                    Lithium <b>#.#.#</b>
                </div>
                <div class="sf-toolbar-info-piece">
                    <a href="http://lithify.me/docs/lithium" rel="help" target="_blank">Lithium Documentation</a>
                </div>
            </div>
        </div>
    </div>
    <!-- PHP -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <span>
                <a href="#">
                    <img width="26" height="28" alt="PHP" src="data:image/png;base64,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">
                </a>
            </span>
        </div>
        <div class="sf-toolbar-info">
            <div class="sf-toolbar-info-piece">
                <div class="sf-toolbar-info-piece sf-toolbar-info-php">
                    <b>PHP</b>
                    <span><?php echo PHP_VERSION; ?></span>
                </div>
                <div class="sf-toolbar-info-piece sf-toolbar-info-php-ext">
                    <b>PHP Extensions</b>
                    <span class="sf-toolbar-status sf-toolbar-status-<?php echo extension_loaded('xdebug') ? 'green' : 'red'; ?>">xdebug</span>
                    <span class="sf-toolbar-status sf-toolbar-status-<?php echo extension_loaded('apc') ? 'green' : 'red'; ?>">apc</span>
                </div>
                <div class="sf-toolbar-info-piece">
                    <b>PHP SAPI</b>
                    <span><?php echo PHP_SAPI; ?></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Environment -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <span>
                <img width="21" height="28" alt="Environment" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAcCAMAAAC5xgRsAAAAZlBMVEX///////////////////////////////////////////////////////////////////////////////////////////+ZmZmZmZlISEhJSUmdnZ1HR0fR0dFZWVlpaWlfX18/Pz+puygPAAAAIXRSTlMACwwlJygpLzIzNjs8QEtMUmd6e32AucDBw8fIydTm6u5l8MjvAAAAo0lEQVR42r2P2Q6CMBBFL6XsZRGRfZv//0nbDBNEE19MnJeTc5ILKf58ahiUwzy/AJpIWwREwQnEXRdbGCLjrO+djWRvVMiJcigxB7viGogxDdJpSmHEmCVPS7YczJvgUu+CS30IvtbNYZMvsGVo2mVpG/kbm4auiCpdcC3YPCAhSpAdUzaAn6qPKZtUT6ZSzb4bi2hdo9MQ1nX4ASjfV+/4/Z40pyCHrNTbIgAAAABJRU5ErkJggg==">
                <?php echo $this->debugBar->get('environment'); ?>
            </span>
        </div>
        <div class="sf-toolbar-info">
            <div class="sf-toolbar-info-piece">
                <b>Environment</b>
                <span><?php echo $this->debugBar->get('environment'); ?></span>
            </div>
        </div>
    </div>
    <!-- Request -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <a href="#">
                <img width="28" height="28" alt="Request" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAQAAADYBBcfAAACvElEQVR42tVTbUhTYRTerDCnKVoUUr/KCZmypA9Koet0bXNLJ5XazDJ/WFaCUY0pExRZXxYiJgsxWWjkaL+yK+po1gjyR2QfmqWxtBmaBtqWGnabT++c11Fu4l/P4VzOPc95zoHznsNZodIbLDdRcKnc1Bu8DAK45ZsOnykQNMopsNooLxCknb0cDq5vml9FtHiIgpBR0R6iihYyFMTDt2Lg56ObPkI6TMGXSof1EV67IqCwisJSWliFAG/E0CfFIiebdNypcxi/1zgyFiIiZ3sJQr0RQx5frLa6k7SOKRo3oMFNR5t62h2rttKXEOKFqDCxtXNmmBokO2KKTlp3IdWuT2dYRNGKwEXEBCcL172G5FG0aIxC0kR9PBTVH1kkwQn+IqJnCE33EalVzT9GJQS1tAdD3CKicJYFrxqx7W2ejCEdZy1FiC5tZxHhLJKOZaRdQJAyV/YAvDliySALHxmxR4Hqe2iwvaOR/CEuZYJFSgYhVbZRkA8KGdEktrqnqra90NndCdkt77fjIHIhexOrfO6O3bbbOj/rqu5IptgyR3sU93QbOYhquZK4MCDp0Ina/PLsu5JvbCTRaapUdUmIV/RzoMdsk/0hWRNdAvKOmvqlN0drsJbJf1P4YsQ5lGrJeuosiOUgbOC8cto3LfOXTdVd7BqZsQKbse+0jUL6WPcesqs4MNSUTQAxGjwFiC8m3yzmqwHJBWYKBJ9WNqW/dHkpU/osch1Yj5RJfXPfSEe/2UPsN490NPfZG5CKyJmcV5ayHyzy7BMqsXfuHhGK/cjAIeSpR92gehR55D8TcQhDEKJwytBJ4fr4NULvrEM8NszfJPyxDoHYAQ1oPCWmIX4gifmDS/DV2DKeb25FHWr76yEG7/9L4YFPeiQQ4/8LkgJ8Et+NncTCsYqzXAEXa7CWdPZzGWdlyV+vST0JanfPvwAAAABJRU5ErkJggg==">
                <span class="sf-toolbar-status sf-toolbar-status-<?php echo $this->debugBar->get('status.code') == 200 ? 'green' : 'red'; ?>">
                    <?php echo $this->debugBar->get('status.code'); ?>
                </span>
                <span class="sf-toolbar-status sf-toolbar-info-piece-additional">
                    <span class="sf-toolbar-info-class">
                        <?php echo $this->debugBar->get('controller'); ?> : <?php echo $this->debugBar->get('action'); ?>
                    </span>
                </span>
            </a>
        </div>
        <div class="sf-toolbar-info">
            <div class="sf-toolbar-info-piece">
                <b>Status Code</b>
                <span class="sf-toolbar-status sf-toolbar-status-<?php echo $this->debugBar->get('status.code') == 200 ? 'green' : 'red'; ?>">
                    <?php echo $this->debugBar->get('status.code'); ?>
                    <?php echo $this->debugBar->get('status.message'); ?>
                </span>
            </div>
            <div class="sf-toolbar-info-piece">
                <b>Controller</b>
                <span class="sf-toolbar-info-class">
                    <?php echo $this->debugBar->get('controller'); ?>
                </span>
            </div>
            <div class="sf-toolbar-info-piece">
                <b>Action</b>
                <span class="sf-toolbar-info-class">
                    <?php echo $this->debugBar->get('action'); ?>
                </span>
            </div>
            <div class="sf-toolbar-info-piece">
                <b>Session</b>
                <span><?php echo $this->debugBar->get('session.started') ? 'yes' : 'no'; ?></span>
            </div>
        </div>
    </div>
    <!-- Time -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <span>
                <img width="16" height="28" alt="Time" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAABqUlEQVR42t2Vv0sCYRyHX9OmEhsMx/YKGlwLQ69DTEUSBJEQEy5J3FRc/BsuiFqEIIcQIRo6ysUhoaBBWhoaGoJwiMJLglRKrs8bXgienmkQdPDAwX2f57j3fhFJkkbiPwTK5bIiFoul3kmPud8MqKMewDXpwuGww+12n9hsNhFnlijYf/Z4PDmO45Yxo+10ZFGTyWRMEItU6AdCx7lczkgd6n7J2Wx2xm63P6jJMk6n80YQBBN1aUDv9XqvlAbbm2LE7/cLODRB0un0VveAeoDC8/waCQQC18MGQqHQOcEKvw8bcLlcL6TfYnVtCrGRAlartUUYhmn1jKg/E3USjUYfhw3E4/F7ks/nz4YNFIvFQ/ogbUYikdefyqlU6gnuOg2YK5XKvs/n+xhUDgaDTVEUt+HO04ABOBA5isViDTU5kUi81Wq1AzhWMEkDGmAEq2C3UCjcYXGauDvfEsuyUjKZbJRKpVvM8IABU9SVX+cxYABmwIE9cFqtVi9xtgvsC2AHbIAFoKey0gdlHEyDObAEWLACFsEsMALdIJ80+dK0bTS95v7+v/AJnis0eO906QwAAAAASUVORK5CYII=">
                <span><?php echo round($this->debugBar->get('runtime'), 3); ?> s</span>
            </span>
        </div>
        <div class="sf-toolbar-info">
            <div class="sf-toolbar-info-piece">
                <table width="500">
                    <thead>
                        <tr>
                            <th width="1"><b>Time</b></th>
                            <th width="1"><b>Memory</b></th>
                            <th><b>Event</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $maxMemory = memory_get_peak_usage(true); ?>
                        <?php foreach ($this->debugBar->get('events') as $i => $event): ?>
                            <tr>
                                <td width="1">
                                    <?php $_time = isset($event['time']) ? round((float) $event['time'], 3) : 0.000; ?>
                                    <?php echo $_time < 0.1 ? '-' : "{$_time} s"; ?>
                                </td>
                                <td width="1">
                                    <?php $_memory = isset($event['memory']) ? $event['memory'] / 1024 : 0; ?>
                                    <?php if ($_memory < 1024): ?>
                                        <?php if ($_memory > 0): ?>
                                            <?php $_percent = ($_memory / ($maxMemory / 1024)) * 100; ?>
                                            <?php echo $_memory; ?> KB (<?php echo round($_percent, 1); ?>%)
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php $_percent = (($_memory / 1024) / ($maxMemory / 1024 / 1024)) * 100; ?>
                                        <?php echo $_memory / 1024; ?> MB (<?php echo round($_percent, 1); ?>%)
                                    <?php endif; ?>
                                </td>
                                <td><?php echo isset($event['name']) ? $event['name'] : 'n/a'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if ($this->debugBar->get('log.count')): ?>
        <!-- Log -->
        <div class="sf-toolbar-block">
            <div class="sf-toolbar-icon">
                <a href="#">
                    <img width="17" height="28" alt="Logs" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAcCAYAAACH81QkAAAA9klEQVQ4y2P4//8/A6WYYZgZYm9vD8I8QHwAiP+TgP8B8RSYIQJAfBQqcRmI5xCBdwDxV6iebpAh+6CcLUDMCHUZMdgOiN+A9DIgOe8u1EWXCOBdQCwGNWg7zJAvJIYFCO+BGjINZshnMgx5DTWknxJDHkMNmUiqISAvvKTEkC6opnQo/wmphsyAahBCSg54DbkPxAZQjSD+AqhiESA+QWyYHEFKTPFI7AOkBuw2JM3MQLyb3NhZB8QqQLyR0ih+RkQ6mUpJYnsENQSUow+Ta8hbIOaC5mQpkCG/yDDkBtQQeMn2FIg/koBvArEZLAaHY2k/aAwBAP6jtd/ja0xbAAAAAElFTkSuQmCC">
                    <span class="sf-toolbar-status"><strong><?php echo $this->debugBar->get('log.count'); ?></strong></span>
                </a>
            </div>
            <div class="sf-toolbar-info">
                <div class="sf-toolbar-info-piece">
                    <table width="500" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1">&nbsp;</th>
                                <th width="1"><b>Priority</b></th>
                                <th><b>Message</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->debugBar->get('log') as $_i => $_entry): ?>
                                <?php
                                switch ($_entry['priority']) {
                                    case 'emergency':
                                    case 'alert':
                                        $class = ' class="danger"';
                                        break;
                                    case 'critical':
                                    case 'error':
                                        $class = ' class="warning"';
                                        break;
                                    case 'warning':
                                    case 'notice':
                                        $class = ' class="info"';
                                        break;
                                    case 'info':
                                    case 'debug':
                                    default:
                                        $class = null;
                                        break;
                                }
                                ?>
                                <tr<?php echo $class; ?>>
                                    <td width="1"><?php echo $_i + 1; ?></td>
                                    <td width="1"><?php echo $_entry['priority']; ?></td>
                                    <td><?php echo $_entry['message']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($this->debugBar->get('exception')): ?>
        <!-- Exception -->
        <div class="sf-toolbar-block">
            <div class="sf-toolbar-icon">
                <a href="#">
                    <img width="15" height="28" alt="Exceptions" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAA4klEQVQ4y2P4//8/AyWYYXgYwOPp6Xnc3t7+P7EYpB6k7+zZs2ADNEjRjIwDAgKWgAywIUfz8+fPVzg7O/8AGeCATQEQnAfi/SAah/wcV1dXvAYUgORANA75ehcXl+/4DHAABRIe+ZrhbgAhTHsDiEgHBA0glA6GfSDiw5mZma+A+sphBlhVVFQ88vHx+Xfu3Ll7QP5haOjjwtuAuGHv3r3NIMNABqh8+/atsaur666vr+9XUlwSHx//AGQANxCbAnEWyGQicRMQ9wBxIQM0qjiBWAFqkB00/glhayBWHwb1AgB38EJsUtxtWwAAAABJRU5ErkJggg==">
                    <span class="sf-toolbar-status sf-toolbar-status-red"><strong>!</strong></span>
                </a>
            </div>
            <div class="sf-toolbar-info">
                <?php if ($type = $this->debugBar->get('exception.type')): ?>
                    <div class="sf-toolbar-info-piece">
                        <b>Error</b>
                        <span class="sf-toolbar-status">
                            <?php echo strtoupper($type); ?>
                        </span>
                    </div>
                <?php else: ?>
                    <div class="sf-toolbar-info-piece">
                        <b>Exception</b>
                        <span class="sf-toolbar-status">
                            <?php echo $this->debugBar->get('exception.class'); ?>
                        </span>
                    </div>
                    <div class="sf-toolbar-info-piece">
                        <b>Code</b>
                        <span class="sf-toolbar-status">
                            <?php echo $this->debugBar->get('exception.code'); ?>
                        </span>
                    </div>
                <?php endif; ?>
                <div class="sf-toolbar-info-piece">
                    <b>Message</b>
                    <span class="sf-toolbar-status sf-toolbar-status-red">
                        <?php echo $this->debugBar->get('exception.message'); ?>
                    </span>
                </div>
                <div class="sf-toolbar-info-piece">
                    <b>File</b>
                    <span>
                        <?php $file = $this->debugBar->get('exception.file'); ?>
                        <?php $line = $this->debugBar->get('exception.line'); ?>
                        <a href="<?php echo $this->debugBar->getEditorHref($file, $line); ?>">
                            <?php echo $file; ?>:<?php echo $line; ?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Memory -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <span>
                <img width="13" height="28" alt="Memory Usage" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAcBAMAAABITyhxAAAAJ1BMVEXNzc3///////////////////////8/Pz////////////+NjY0/Pz9lMO+OAAAADHRSTlMAABAgMDhAWXCvv9e8JUuyAAAAQ0lEQVQI12MQBAMBBmLpMwoMDAw6BxjOOABpHyCdAKRzsNDp5eXl1KBh5oHBAYY9YHoDQ+cqIFjZwGCaBgSpBrjcCwCZgkUHKKvX+wAAAABJRU5ErkJggg==">
                <span><?php echo $this->debugBar->get('memory.usage') / 1024 / 1024; ?> MB</span>
            </span>
        </div>
        <div class="sf-toolbar-info">
            <div class="sf-toolbar-info-piece">
                <b>Memory usage</b>
                <span><?php echo $this->debugBar->get('memory.usage') / 1024 / 1024; ?> MB</span>
            </div>
        </div>
    </div>
    <!-- Auth -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <a href="#">
                <img width="24" height="28" alt="Security" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAcCAYAAAB75n/uAAAC70lEQVR42u2V3UtTYRzHu+mFwCwK+gO6CEryPlg7yiYx50vDqUwjFIZDSYUk2ZTmCysHvg9ZVggOQZiRScsR4VwXTjEwdKZWk8o6gd5UOt0mbev7g/PAkLONIOkiBx+25/v89vuc85zn2Q5Fo9F95UDwnwhS5HK5TyqVRv8m1JN6k+AiC+fn54cwbgFNIrTQ/J9IqDcJJDGBHsgDgYBSq9W6ysvLPf39/SSUUU7zsQ1yc3MjmN90OBzfRkZG1umzQqGIxPSTkIBjgdDkaGNjoza2kcFgUCE/QvMsq6io2PV6vQu1tbV8Xl7etkql2qqvr/+MbDE/Pz8s9OP2Cjhwwmw29+4R3Kec1WZnZ4fn5uamc3Jyttra2qbH8ero6JgdHh5+CvFHq9X6JZHgzODgoCVW0NPTY0N+ltU2Nzdv4GqXsYSrPp+vDw80aLFYxru6uhyQ/rDb7a8TCVJDodB1jUazTVlxcXGQ5/mbyE+z2u7u7veY38BVT3Z2djopm5qa6isrK/tQWVn5qb29fSGR4DC4PDAwMEsZHuArjGnyGKutq6v7ajQaF6urq9/MzMz0QuSemJiwQDwGkR0POhhXgILjNTU1TaWlpTxlOp1uyWQyaUjMajMzM8Nut/tJQUHBOpZppbCwkM/KytrBznuL9xDVxBMo8KXHYnu6qKjIivmrbIy67x6Px4Yd58W672ApfzY0NCyNjo7OZmRkiAv8fr+O47iwmABXtoXaG3uykF6vX7bZbF6cgZWqqiqezYkKcNtmjO+CF2AyhufgjsvlMiU7vXEF+4C4ALf9CwdrlVAqlcFkTdRqdQSHLUDgBEeSCrArAsiGwENs0XfJBE6ncxm1D8Aj/B6tigkkJSUlmxSwLYhMDeRsyyUCd+lHrWxtbe2aTCbbZTn1ZD92F0Cr8GBfgnsgDZwDt8EzMBmHMXBLqD0PDMAh9Gql3iRIESQSIAXp4CRIBZeEjIvDFZAm1J4C6UK9ROiZcvCn/+8FvwHtDdJEaRY+oQAAAABJRU5ErkJggg==">
                <span class="sf-toolbar-status sf-toolbar-status-<?php echo $this->debugBar->get('auth') ? 'green' : 'red'; ?>"><?php echo $this->debugBar->get('auth.id'); ?></span>
            </a>
        </div>
        <div class="sf-toolbar-info" style="min-width:400px">
            <?php if ($this->debugBar->get('auth')): ?>
                <pre style="font-size:10px; line-height:12px"><?php print_r($this->debugBar->get('auth.data')); ?></pre>
            <?php else: ?>
                You are not authenticated.
            <?php endif; ?>
        </div>
    </div>
    <!-- DB -->
    <div class="sf-toolbar-block">
        <div class="sf-toolbar-icon">
            <a href="#">
                <img width="20" height="28" alt="Database" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAYAAABh2p9gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQRJREFUeNpi/P//PwM1ARMDlcGogZQDlpMnT7pxc3NbA9nhQKxOpL5rQLwJiPeBsI6Ozl+YBOOOHTv+AOllQNwtLS39F2owKYZ/gRq8G4i3ggxEToggWzvc3d2Pk+1lNL4fFAs6ODi8JzdS7mMRVyDVoAMHDsANdAPiOCC+jCQvQKqBQB/BDbwBxK5AHA3E/kB8nKJkA8TMQBwLxaBIKQbi70AvTADSBiSadwFXpCikpKQU8PDwkGTaly9fHFigkaKIJid4584dkiMFFI6jkTJII0WVmpHCAixZQEXWYhDeuXMnyLsVlEQKI45qFBQZ8eRECi4DBaAlDqle/8A48ip6gAADANdQY88Uc0oGAAAAAElFTkSuQmCC">
                <?php

                $invalid = $this->debugBar->get('db.invalid');
                $valid = $this->debugBar->get('db.count');

                ?>
                <span class="sf-toolbar-status sf-toolbar-status-green">
                    <?= $valid ?>
                </span>
                </span>
                <?php if ($invalid > 0) {
                    $valid -= $invalid;
                ?>
                <span class="sf-toolbar-status sf-toolbar-status-red">
                    <?= $invalid ?>
                </span>
                <?php } ?>
                <span style='margin-left:3px'>
                    <?php echo round($this->debugBar->get('db.time'), 3); ?> s
                </span>
            </a>
        </div>
        <div class="sf-toolbar-info" style="height:500px;overflow:scroll">
            <div class="sf-toolbar-info-piece">
                <table width="750">
                <thead>
                    <th>namespace</th>
                    <th>Fields</th>
                    <th>Conditions</th>
                    <th>Order</th>
                    <th>Entities</th>
                    <th>Limit</th>
                    <th>Skip</th>
                    <th>T-millis</th>
                </thead>
                <tbody>
                <?php

                $queries = $this->debugBar->get('db.queries');
                $countQueries = 1;
                foreach($queries as $query) {
                    foreach ($query as $s) {
                ?>
                <tr>
                    <td>
                    <?= $s['query']['ns'] ?>
                    </td>
                    <td>
                    <?php
                        $fields = isset($s['query']['fields']) ? $s['query']['fields'] : array();

                        if (empty($fields)) {
                            echo '<i>all</i>';
                        } else {
                            foreach ($fields as $key => $val) {
                                echo join(': ', array($key, !empty($val) ? $val : 'null'));
                                echo "<br>";
                            }
                        }
                        ?>
                    </td>
                    <td>
                    <?php
                        $conditions = isset($s['query']['query']['$query']) ? $s['query']['query']['$query'] : array();

                        if (empty($conditions)) {
                            echo '<i>none</i>';
                        } else {
                            foreach ($conditions as $key => $val){
                                if (is_array($val)) {
                                    try {
                                        $val = join(', <br>', @call_user_func_array('array_merge', $val));
                                    } catch (\Exception $e) {
                                        $val = join(', <br>', $val);
                                    }
                                }
                                echo join(': ', array($key, !empty($val) ? $val : 'null'));
                                echo "<br>";
                            }
                        }
                    ?>
                    </td>
                    <td>
                    <?php
                        $orderby = isset($s['query']['query']['$orderby']) ? $s['query']['query']['$orderby'] : array();

                        if (empty($orderby)) {
                            echo '<i>none</i>';
                        } else {
                            foreach ($orderby as $key => $val){
                                echo join(': ', array($key, !empty($val) ? $val : 'null'));
                                echo "<br>";
                            }
                        }
                    ?>
                    </td>
                    <td style="text-align:center"><?=$s['explain']['n']?></td>
                    <td style="text-align:center"><?=$s['query']['limit']?></td>
                    <td style="text-align:center"><?=$s['query']['skip']?></td>
                    <td style="text-align:center"><?=$s['explain']['millis']?></td>
					</tr>
					<tr><td colspan="8">
					<a class="slide" href="#" onclick='
						var element = document.getElementById("explain<?= $countQueries ?>");
						if (element.style.display == "block") {
							element.style.display = "none";
						}
						else {
							element.style.display = "block";
						};'>explain >></a>

					<span id="explain<?= $countQueries ?>" class="explainToggle">
					<?php

					$explain = $s['explain'];

					var_dump($explain);

					?>
					</span>
					</td>
                    </tr>
                    <?php
						$countQueries++;
						}
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a class="hide-button" title="Close Toolbar" onclick="
        var p = this.parentNode;
        p.style.display = 'none';
        (p.previousElementSibling || p.previousSibling).style.display = 'none';
        document.getElementById('sfMiniToolbar').style.display = 'block';
        Sfjs.setPreference('toolbar/displayState', 'none');
    "></a>
</div>

<style>
.sf-minitoolbar {
    display: none;

    position: fixed;
    bottom: 0;
    right: 0;

    padding: 5px 5px 0;

    background-color: #f7f7f7;
    background-image: -moz-linear-gradient(top, #e4e4e4, #ffffff);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e4e4e4), to(#ffffff));
    background-image: -o-linear-gradient(top, #e4e4e4, #ffffff);
    background: linear-gradient(top, #e4e4e4, #ffffff);

    border-radius: 16px 0 0 0;

    z-index: 6000000;
}

.sf-toolbarreset {
    position: fixed;
    background-color: #f7f7f7;
    left: 0;
    right: 0;
    height: 38px;
    margin: 0;
    padding: 0 40px 0 0;
    z-index: 6000000;
    font: 11px Verdana, Arial, sans-serif;
    text-align: left;
    color: #2f2f2f;

    background-image: -moz-linear-gradient(top, #e4e4e4, #ffffff);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e4e4e4), to(#ffffff));
    background-image: -o-linear-gradient(top, #e4e4e4, #ffffff);
    background: linear-gradient(top, #e4e4e4, #ffffff);

    bottom: 0;
    border-top: 1px solid #bbb;
}
.sf-toolbarreset abbr {
    border-bottom: 1px dotted #000000;
    cursor: help;
}
.sf-toolbarreset span,
.sf-toolbarreset div {
    font-size: 11px;
}
.sf-toolbarreset img {
    width: auto;
    display: inline;
}

.sf-toolbarreset .hide-button {
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    width: 40px;
    height: 40px;
    cursor: pointer;
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAllBMVEXDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PExMTPz8/Q0NDR0dHT09Pb29vc3Nzf39/h4eHi4uLj4+P6+vr7+/v8/Pz9/f3///+Nh2QuAAAAIXRSTlMABgwPGBswMzk8QktRV4SKjZOWmaKlq7TAxszb3urt+fy1vNEpAAAAiklEQVQIHUXBBxKCQBREwRFzDqjoGh+C2YV//8u5Sll2S0E/dof1tKdKM6GyqCto7PjZRJIS/mbSELgXOSd/BzpKIH1ZefVWpDDTHsi8mZVnwImPi5ndCLbaAZk3M58Bay0h9VbeSvMpjDUAHj4jL55AW1rxN5fU2PLjIgVRzNdxVFOlGzvnJi0Fb1XNGBHA9uQOAAAAAElFTkSuQmCC');
    background-repeat: no-repeat;
    background-position: 13px 11px;
}

.sf-toolbar-block {
    white-space: nowrap;
    color: #2f2f2f;
    display: block;
    min-height: 28px;
    border-right: 1px solid #e4e4e4;
    padding: 0;
    float: left;
    cursor: default;
}

.sf-toolbar-block span {
    display: inline-block;
}

.sf-toolbar-block .sf-toolbar-info-piece {
    line-height: 19px;
    margin-bottom: 5px;
}

.sf-toolbar-block .sf-toolbar-info-piece .sf-toolbar-status {
    padding: 0px 5px;
    border-radius: 5px;
    margin-bottom: 0px;
    vertical-align: top;
}

.sf-toolbar-block .sf-toolbar-info-piece:last-child {
    margin-bottom: 0;
}

.sf-toolbar-block .sf-toolbar-info-piece a,
.sf-toolbar-block .sf-toolbar-info-piece abbr {
    color: #2f2f2f;
}

.sf-toolbar-block .sf-toolbar-info-piece b {
    display: inline-block;
    width: 110px;
    vertical-align: top;
}

.sf-toolbar-block .sf-toolbar-info-with-next-pointer:after {
    content: ' :: ';
    color: #999;
}

.sf-toolbar-block .sf-toolbar-info-with-delimiter {
    border-right: 1px solid #999;
    padding-right: 5px;
    margin-right: 5px;
}

.sf-toolbar-block .sf-toolbar-info {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #bbb;
    padding: 9px 0;
    margin-left: -1px;

    bottom: 38px;
    border-bottom-width: 0;
    border-bottom: 1px solid #bbb;
    border-radius: 4px 4px 0 0;
}

.sf-toolbarreset > div:last-of-type .sf-toolbar-info {
    right: -1px;
}

.sf-toolbar-block .sf-toolbar-info:empty {
    visibility: hidden;
}

.sf-toolbar-block .sf-toolbar-status {
    display: inline-block;
    color: #fff;
    background-color: #666;
    padding: 3px 6px;
    border-radius: 3px;
    margin-bottom: 2px;
    vertical-align: middle;
    min-width: 6px;
    min-height: 13px;
}

.sf-toolbar-block .sf-toolbar-status abbr {
    color: #fff;
    border-bottom: 1px dotted black;
}

.sf-toolbar-block .sf-toolbar-status-green {
    background-color: #759e1a;
}

.sf-toolbar-block .sf-toolbar-status-red {
    background-color: #a33;
}

.sf-toolbar-block .sf-toolbar-status-yellow {
    background-color: #ffcc00;
    color: #000;
}

.sf-toolbar-block .sf-toolbar-status-black {
    background-color: #000;
}

.sf-toolbar-block .sf-toolbar-icon {
    display: block;
}

.sf-toolbar-block .sf-toolbar-icon > a,
.sf-toolbar-block .sf-toolbar-icon > span {
    display: block;
    text-decoration: none;
    margin: 0;
    padding: 5px 8px;
    min-width: 20px;
    text-align: center;
    vertical-align: middle;
}

.sf-toolbar-block .sf-toolbar-icon > a,
.sf-toolbar-block .sf-toolbar-icon > a:link
.sf-toolbar-block .sf-toolbar-icon > a:hover {
    color: black !important;
}

.sf-toolbar-block .sf-toolbar-icon img {
    border-width: 0;
    vertical-align: middle;
}

.sf-toolbar-block .sf-toolbar-icon img + span {
    margin-left: 5px;
    margin-top: 2px;
}

.sf-toolbar-block .sf-toolbar-icon .sf-toolbar-status {
    border-radius: 12px;
    border-bottom-left-radius: 0;
    margin-top: 0;
}

.sf-toolbar-block .sf-toolbar-info-method {
    border-bottom: 1px dashed #ccc;
    cursor: help;
}

.sf-toolbar-block .sf-toolbar-info-method[onclick=""] {
    border-bottom: none;
    cursor: inherit;
}

.sf-toolbar-info-php {}
.sf-toolbar-info-php-ext {}

.sf-toolbar-info-php-ext .sf-toolbar-status {
    margin-left: 2px;
}

.sf-toolbar-info-php-ext .sf-toolbar-status:first-child {
    margin-left: 0;
}

.sf-toolbar-block a .sf-toolbar-info-piece-additional,
.sf-toolbar-block a .sf-toolbar-info-piece-additional-detail {
    display: inline-block;
}

.sf-toolbar-block a .sf-toolbar-info-piece-additional:empty,
.sf-toolbar-block a .sf-toolbar-info-piece-additional-detail:empty {
    display: none;
}

.sf-toolbarreset:hover {
    box-shadow: rgba(0, 0, 0, 0.3) 0 0 50px;
}

.sf-toolbar-block:hover {
    box-shadow: rgba(0, 0, 0, 0.35) 0 0 5px;
    border-right: none;
    margin-right: 1px;
    position: relative;
}

.sf-toolbar-block:hover .sf-toolbar-icon {
    background-color: #fff;
    border-top: 1px dotted #DDD;
    position: relative;
    margin-top: -1px;
    z-index: 10002;
}

.sf-toolbar-block:hover .sf-toolbar-info {
    display: block;
    min-width: -webkit-calc(100% + 2px);
    min-width: calc(100% + 2px);
    z-index: 10001;
    box-sizing: border-box;
    padding: 9px;
    line-height: 19px;
}

.sf-toolbar-block table td,
.sf-toolbar-block table th {
    padding-left:5px;
}

span.explainToggle {
	display: none;
}

/*.sf-toolbarreset {
    position: static;
    background: #cbcbcb;

    background-image: -moz-linear-gradient(90deg, #cbcbcb, #e8e8e8); !important;
    background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, from(#cbcbcb), to(#e8e8e8)); !important;
    background-image: -o-linear-gradient(180deg, #cbcbcb, #e8e8e8); !important;
    background: linear-gradient(90deg, #cbcbcb, #e8e8e8); !important;
}*/

/***** Media query *****/
@media screen and (max-width: 779px) {
    .sf-toolbar-block .sf-toolbar-icon > * > :first-child ~ * {
        display: none;
    }

    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional,
    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
        display: none !important;
    }
}

@media screen and (min-width: 880px) {
    .sf-toolbar-block .sf-toolbar-icon a[href$="config"] .sf-toolbar-info-piece-additional {
        display: inline-block;
    }
}

@media screen and (min-width: 980px) {
    .sf-toolbar-block .sf-toolbar-icon a[href$="security"] .sf-toolbar-info-piece-additional {
        display: inline-block;
    }
}

@media screen and (max-width: 1179px) {
    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional {
        display: none;
    }
}

@media screen and (max-width: 1439px) {
    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
        display: none;
    }
}

/* Twitter Bootstrap 3 */
.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
  border-color: #d6e9c6;
}

.table-hover > tbody > tr > td.success:hover,
.table-hover > tbody > tr > th.success:hover,
.table-hover > tbody > tr.success:hover > td {
  background-color: #d0e9c6;
  border-color: #c9e2b3;
}

.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
  border-color: #eed3d7;
}

.table-hover > tbody > tr > td.danger:hover,
.table-hover > tbody > tr > th.danger:hover,
.table-hover > tbody > tr.danger:hover > td {
  background-color: #ebcccc;
  border-color: #e6c1c7;
}

.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
  border-color: #fbeed5;
}

.table-hover > tbody > tr > td.warning:hover,
.table-hover > tbody > tr > th.warning:hover,
.table-hover > tbody > tr.warning:hover > td {
  background-color: #faf2cc;
  border-color: #f8e5be;
}

.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #F0F7FD;
  border-color: #D0E3F0;
}

.table-hover > tbody > tr > td.info:hover,
.table-hover > tbody > tr > th.info:hover,
.table-hover > tbody > tr.info:hover > td {
  background-color: #D9EDF7;
  border-color: #BCE8F1;
}
</style>
