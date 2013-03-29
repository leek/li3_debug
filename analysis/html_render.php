<style type="text/css">
	.debug {
		width: 960px;
		margin: 0 auto;
	}
	.debug-buttons {
		font-size: 0;
	}
	.debug-button {
		padding: 4px 18px;
		color: #333;
		text-align: center;
		cursor: pointer;
		border: 1px solid #000;
		font-size: 14px;
		line-height: 20px;
		color: #fff;
		background: #222;
	}
	.debug-button:hover, .debug-button.active {
		background: #444;
	}
	.debug-filters {
		list-style-type: none;
		margin: 15px 0;
	}
	.debug-filter {
		color: #2e81b0;
		display: inline-block;
	}
	.debug-filter:hover, .debug-filter.active {
		cursor: pointer;
		color: #333;
	}
	.debug-filter:not(:last-child)::after {
		content: '|';
		margin: 0 10px;
		color: #666;
	}
	.debug-table {
		border: 1px solid #BED6EB;
		margin: 0 auto;
		padding: 0;
		background-color: #F3F7FB;
		margin-top: 20px;
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 40px;
	}
	.debug-table td {
		padding: 5px;
		border-top: 1px solid #BED6EB;
	}
	.debug-table pre {
		width: 695px;
		word-wrap: break-word;
	}
	.debug-time {
		text-align: right;
	}
	.debug-table tr:hover {
		background-color: #fff;
	}
	.debug-table .green {
		background-color: #4eb236;
		color: #fff;
	}
	.debug-table .red {
		background-color: red;
		color: #fff;
	}
	.debug-table .orange {
		background-color: orange;
		color: #fff;
	}
	.debug-table .blue {
		background-color: #2b6ce3;
		color: #fff;
	}
	.debug-db {
		font-family: monospace;
	}
		.debug-db div {
			width: 680px;
			word-wrap: break-word;
		}
	.debug-type {
		font-family: monospace;
		text-align: right;
	}
</style>
<script>
(function ($, jQuery, console) {
"use strict";
// Class Debugger
var Debugger = {
	nbRequest: 0,

	addResponse : function (url, data) {
		var self = Debugger,
			$debugTable = $('[data-debug-rel="debug"]'),
			tabs = $debugTable.find('[data-debug-rel="request-list"]'),
			table = '',
			content = '',
			klass = '', count = 0, klassDiff = '', log;

		// Add tab
		self.nbRequest++;
		tabs.append('<li class="debug-filter" data-debug-value="' + self.nbRequest + '">' + url + '</li>');

		// Create content
		content = '<table data-debug-value="' + self.nbRequest + '" data-debug-rel="request" class="debug-table">'

		for (var i = 0; i < data.logs.length; i++) {
			log = data.logs[i];

			if (log.time > 1) {
				klass = 'red';
			} else if (log.time > 0.4) {
				klass = 'orange';
			} else if (log.time < 0.05) {
				klass = 'blue';
			} else {
				klass = 'green';
			}

			if (log.diff > 1) {
				klassDiff = 'red';
			} else if (log.diff > 0.4) {
				klassDiff = 'orange';
			} else if (log.diff < 0.05) {
				klassDiff = 'blue';
			} else {
				klassDiff = 'green';
			}

			if (log.data && typeof(log.data.count) !== 'undefined') {
				count = log.data.count;
			}

			content += '<tr data-debug-type="' + log.type + '">';
			content += '<td class="debug-time">' + log.timeline + '</td>';
			content += '<td class="debug-time ' + klass + '">' + log.time + '</td>';
			content += '<td class="debug-time ' + klassDiff + '">+' + log.diff + '</td>';
			content += '<td class="debug-time">' + count + '</td>';
			content += '<td class="debug-db">[' + log.type + '] ' + log.log + ' </td>';
			content += '</tr>';
		}

		content += '</table>';

		$debugTable.append(content);
		$('[data-debug-rel="request"][data-debug-value="'+self.nbRequest+'"]').hide();

		self.bindTabs();

	},

	bindTabs: function () {
		var self = Debugger;

		$('[data-debug-rel="request-list"]>li').unbind('click').click(function (e) {
			var $this = $(this),
				value = $this.attr('data-debug-value');

			$('[data-debug-rel="request"]').each(function (i) {
				var $request = $(this);

				if ($request.attr('data-debug-value') != value) {
					$request.hide();
				} else {
					$request.show();
				}
			});

			$('[data-debug-rel="request-list"]>li').removeClass('active');
			$this.addClass('active');
		});
	},

	bindFilters: function () {
		$('[data-debug-rel="filter"]').unbind('click').click(function (e) {
			var $filter = $(this),
				type = $filter.attr('data-debug-value');

			$('[data-debug-type]').each(function () {
				var $type = $(this);

				if ($type.attr('data-debug-type') == type || type == 'ALL') {
					$type.show();
				} else {
					$type.hide();
				}
			});

			$('[data-debug-rel="filter"]').removeClass('active');
			$filter.addClass('active');
		});
	},

	bindAjax: function () {
		var self = Debugger;

		// Listen all json requests
		$(document).ajaxComplete(function (e, data, type) {
			var $debugData, data;

			// Add request data
			if (type.dataType == 'html') {
				$debugData = $('[data-debug-rel="data-debug"]');

				if ($debugData && $debugData.length > 0) {
					data = $.parseJSON($debugData.html());

					if (data) {
						// Add data to debugger
						self.addResponse(type.url, data);
					}
					$debugData.remove();
				}
			} else if (type.dataType == 'json') {
				data = $.parseJSON(data.responseText);

				if (data.debug) {
					// Add data to debugger
					self.addResponse(type.url, data.debug);
				}
			}
		});

		// TODO
		$(document).ajaxError(function (e, jqxhr, settings, exception) {});
	},
	init: function () {
		var self = Debugger;

		self.bindFilters();
		self.bindTabs();
		self.bindAjax();
	}
};

jQuery(document).ready(function () {
	Debugger.init();
});

})($, jQuery, console);
</script>

<div class="debug">
	<div data-debug-rel="debug">
		<table class="debug-table">
			<caption>Page stats</caption>
			<tr data-debug-type="ALL">
				<td class="debug-label" colspan="5"><b>Apache</b></td>
				<td><?= $counts['time'] ?> sec. | <?= $size ?> | <?= $counts['files'] ?> includes</td>
			</tr>
			<tr data-debug-type="LITHIUM">
				<td class="debug-label" colspan="5"><b>Lithium</b></td>
				<td><?= $counts['LITHIUM'] ?> sec.</td>
			</tr>
			<tr data-debug-type="ALL">
				<td class="debug-label" colspan="5"><b>Logic</b></td>
				<td><?= $counts['logic'] ?> sec. of logic (no Sql, no Cache, no Webservice).</td>
			</tr>
			<tr data-debug-type="RENDER">
				<td class="debug-label" colspan="5"><b>View render</b></td>
				<td><?= $counts['RENDER'] ?> sec.</td>
			</tr>
			<tr data-debug-type="DB">
				<td class="debug-label" colspan="5"><b>Database</b></td>
				<td><?= $counts['DB'] ?> sec. <?= $counts['nbRequests'] ?> request(s).</td>
			</tr>
			<tr data-debug-type="CACHE">
				<td class="debug-label" colspan="5"><b>Cache</b></td>
				<td><?= $counts['CACHE'] ?> sec.</td>
			</tr>
		</table>
		<ul data-debug-rel="request-list" class="debug-filters">
			<li data-debug-value="base" class="debug-filter active">Global</li>
		</ul>

		<div class="debug-buttons">
			<button class="debug-button active" data-debug-rel="filter" data-debug-value="ALL">All</button>
			<button class="debug-button" data-debug-rel="filter" data-debug-value="DB">Database</button>
			<button class="debug-button" data-debug-rel="filter" data-debug-value="LITHIUM">Lithium</button>
			<button class="debug-button" data-debug-rel="filter" data-debug-value="CACHE">Cache</button>
			<button class="debug-button" data-debug-rel="filter" data-debug-value="RENDER">Render</button>
		</div>

		<table data-debug-value="base" data-debug-rel="request" class="debug-table">
			<thead>
				<tr>
					<th>Timeline</th>
					<th>Time spent</th>
					<th>Delta</th>
					<th>Result count</th>
					<th>Type</th>
					<th>Description</th>
				</tr>
			</thead>

			<tbody>
			<?php foreach ($logs as $log) :
					// Determinate color
					if ($log['time'] > 1) {
						$class = 'red';
					} elseif ($log['time'] > 0.4) {
						$class = 'orange';
					} elseif ($log['time'] < 0.05) {
						$class = 'blue';
					} else {
						$class = 'green';
					}

					if ($log['diff'] > 1) {
						$classDiff = 'red';
					} elseif ($log['diff'] > 0.4) {
						$classDiff = 'orange';
					} elseif ($log['diff'] < 0.05) {
						$classDiff = 'blue';
					} else {
						$classDiff = 'green';
					} ?>
					<tr data-debug-type="<?= $log['type'] ?>">
						<td class="debug-time"><?= $log['timeline']; ?></td>
						<td class="debug-time <?= $class ?>"><?= $log['time'] ?></td>
						<td class="debug-time <?= $classDiff ?>">+<?= $log['diff'] ?></td>
						<td class="debug-time"><?= empty($log['data']['count']) ? '' : $log['data']['count'] ?></td>
						<td class="debug-type">[<?= $log['type'] ?>]</td>
						<td class="debug-db"><div><?= $log['log'] ?></div></td>
					</tr>
				<?php endforeach; ?>
			</tbody>

			<tfoot>
				<?php if ($displaySession) : ?>
					<tr data-debug-type="ALL">
						<td class="debug-label" colspan="5"><b>Session</b></td>
						<td><?php d($_SESSION) ?></td>
					</tr>
				<?php endif; ?>

				<?php if ($displayFileStack) : ?>
					<tr data-debug-type="ALL">
						<td class="debug-label" colspan="5"><b>Includes</b></td>
						<td>
							<pre><?php
								$important = '$/(models|views|data|controllers)/$';
								foreach ($includedFiles as $filename) {
									preg_match($important, $filename, $matches);
									if (count($matches)) {
										if (strpos($filename, '/libraries/lithium/') == false) {
											echo "$filename<br>";
										}
									}
								}
							?>
							</pre>
						</td>
					</tr>
				<?php endif; ?>
			</tfoot>
		</table>
	</div>
</div>