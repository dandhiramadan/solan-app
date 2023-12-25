@push('styles')
    <style>
        html,
        body {
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
        }
    </style>
@endpush
<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div id="gantt_here" style='width:100%; height:100vh;'></div>
</div>

@push('scripts')
    <script type="text/javascript">
        gantt.attachEvent("onLoadStart", function () {
            gantt.message("Loading...");
        });
        gantt.attachEvent("onLoadEnd", function () {
            gantt.message({
                text: "Loaded " + gantt.getTaskCount() + " tasks, " + gantt.getLinkCount() + " links",
                expire: 8 * 1000
            });
        });

        //markers
        gantt.plugins({
            marker: true
        });
        var markers = gantt.addMarker({
            start_date: new Date(),
            css: "today",
            text: "Hari ini",
        });
        //endmarker

        setInterval(function() {
            var today = gantt.getMarker(markers);
            today.start_date = new Date();
            gantt.updateMarker(markers);
        }, 100 * 60);

        gantt.config.date_format = '%d-%m-%Y %H:%i';
        gantt.config.work_time = true;
        gantt.config.skip_off_time = true;
        gantt.config.duration_unit = 'hour';
        gantt.config.duration_step = 1;
        gantt.config.autofit = true;
        gantt.config.order_branch = true;
        gantt.config.scales = [
            {
            unit: 'day',
            format: '%d %F %Y'
            },
            {
            unit: 'hour',
            step: 1,
            format: '%H:%i'
            }
        ];

        gantt.setWorkTime({
            hours: [8, 12, 13, 20]
        });


        gantt.init("gantt_here");

        gantt.parse({
			data: [
				// { id: 1, text: "Project #2", start_date: "24-12-2023", duration: 18, progress: 0.4, open: true },
				{ id: 1, text: "Project #2", start_date: "24-12-2023 08:00:00", duration: 5, progress: 1, type:"project" },
				{ id: 2, text: "Task #1", start_date: "24-12-2023 08:00:00", duration: 3, progress: 0.6, parent: 1 },
				{ id: 3, text: "Task #2", start_date: "24-12-2023 12:00:00", duration: 1, progress: 0.6, parent: 1 }
			],
			links: [
				// {id: 1, source: 1, target: 2, type: "1"},
				// {id: 2, source: 2, target: 3, type: "0"}
			]
		});
        // gantt.load("/api/data");

        // const dp = gantt.createDataProcessor({
        //     url: "/api",
        //     mode: "REST"
        // });
    </script>
@endpush
