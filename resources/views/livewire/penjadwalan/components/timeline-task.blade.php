@push('styles')
    <style>
        html,
        body {
            height: 100vh;
            padding: 0px;
            margin: 0px;
            /* overflow: hidden; */
        }

        .scaleHeaderText
        {
	        font-size:12px!important;
        }

        .gridHeaderText
        {
	        font-size:12px;
	        font-weight:bold;
	        //color:white
        }

		.gantt_task_scale
		{
		    font-size: 12px!important;
		}

		.gantt_grid_scale
		{
		    font-size: 12px!important;
		}

		.gantt_task_content
		{
		    font-size: 12px!important;
	  	}

		.gantt_tree_content
		{
		    font-size: 12px!important;
	  	}

		.nested_task .gantt_add
		{
		   display: none !important;
		}
    </style>
@endpush
<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    Filter tasks: <input id='filter' type='field' style='width:150px' />
    <div id="gantt_here" style='width:100%; height:100vh;'></div>
</div>

@push('scripts')
    <script type="text/javascript">
        gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
        gantt.config.order_branch = true;
        gantt.config.order_branch_free = true;
        gantt.config.work_time = true;
        gantt.config.duration_unit = "hour";
        gantt.config.duration_step = 1;
        gantt.config.autofit = true;
        gantt.config.order_branch = true;
        gantt.config.sort = true;
        gantt.config.scales = [{
                unit: "day",
                format: "%d %F %Y"
            },
            {
                unit: "hour",
                step: 1,
                format: "%H:%i"
            }
        ];

        gantt.setWorkTime({
            hours: [8, 12, 13, 20]
        });


        gantt.plugins({
            marker: true,
            multiselect: true
        });

        var markers = gantt.addMarker({
            start_date: new Date(),
            css: "today",
            text: "Today",
        });

        //limit drag project task
        gantt.templates.task_class = function(st, end, item) {
            return gantt.getChildren(item.id).length ? "gantt_project" : "";
        };

        function limitMoveLeft(task, limit) {
            var dur = task.end_date - task.start_date;
            task.end_date = new Date(limit.end_date);
            task.start_date = new Date(+task.end_date - dur);
        }

        function limitMoveRight(task, limit) {
            var dur = task.end_date - task.start_date;
            task.start_date = new Date(limit.start_date);
            task.end_date = new Date(+task.start_date + dur);
        }

        function limitResizeLeft(task, limit) {
            task.end_date = new Date(limit.end_date);
        }

        function limitResizeRight(task, limit) {
            task.start_date = new Date(limit.start_date)
        }

        gantt.attachEvent("onTaskDrag", function(id, mode, task, original, e) {
            var parent = task.parent ? gantt.getTask(task.parent) : null,
                children = gantt.getChildren(id),
                modes = gantt.config.drag_mode;

            var limitLeft = null,
                limitRight = null;

            if (!(mode == modes.move || mode == modes.resize)) return;

            if (mode == modes.move) {
                limitLeft = limitMoveLeft;
                limitRight = limitMoveRight;
            } else if (mode == modes.resize) {
                limitLeft = limitResizeLeft;
                limitRight = limitResizeRight;
            }

            //check parents constraints
            if (parent && +parent.end_date < +task.end_date) {
                limitLeft(task, parent);
            }
            if (parent && +parent.start_date > +task.start_date) {
                limitRight(task, parent);
            }

            //check children constraints
            for (var i = 0; i < children.length; i++) {
                var child = gantt.getTask(children[i]);
                if (+task.end_date < +child.end_date) {
                    limitLeft(task, child);
                } else if (+task.start_date > +child.start_date) {
                    limitRight(task, child)
                }
            }
        });

        //scroll
        gantt.config.layout = {
            css: "gantt_container",
            cols: [{
                    width: 500,
                    minWidth: 200,
                    maxWidth: 600,
                    rows: [{
                            view: "grid",
                            scrollX: "gridScroll",
                            scrollable: true,
                            scrollY: "scrollVer"
                        },

                        // horizontal scrollbar for the grid
                        {
                            view: "scrollbar",
                            id: "gridScroll",
                            group: "horizontal"
                        }
                    ]
                },
                {
                    resizer: true,
                    width: 1
                },
                {
                    rows: [{
                            view: "timeline",
                            scrollX: "scrollHor",
                            scrollY: "scrollVer"
                        },

                        // horizontal scrollbar for the timeline
                        {
                            view: "scrollbar",
                            id: "scrollHor",
                            group: "horizontal"
                        }
                    ]
                },
                {
                    view: "scrollbar",
                    id: "scrollVer"
                }
            ]
        };

        setInterval(function() {
            var today = gantt.getMarker(markers);
            today.start_date = new Date();
            gantt.updateMarker(markers);
        }, 1000 * 60);

        function filter() {
            const filterEl = document.querySelector("#filter")
            filterEl.addEventListener('input', function(e) {
                filterValue = filterEl.value;
                gantt.refreshData();
            });

            let filterValue = "";

            function filterLogic(task, match) {
                match = match || false;

                // check task text
                if (task.text.toLowerCase().indexOf(filterValue.toLowerCase()) > -1) {
                    match = true;
                }

                // check start time
                let startDate = task.start_date;
                if (typeof startDate === 'string') {
                    startDate = startDate.toLowerCase();
                } else if (startDate instanceof Date) {
                    startDate = startDate.toISOString().toLowerCase();
                }
                if (startDate.indexOf(filterValue.toLowerCase()) > -1) {
                    match = true;
                }

                // check duration
                if (task.duration.toString().indexOf(filterValue) > -1) {
                    match = true;
                }

                // check progress
                if (task.progress.toString().indexOf(filterValue) > -1) {
                    match = true;
                }

                // check spkNumber
                if (task.spknumber.toLowerCase().indexOf(filterValue.toLowerCase()) > -1) {
                    match = true;
                }
                // check children
                gantt.eachTask(function(child) {
                    if (filterLogic(child)) {
                        match = true;
                    }
                }, task.id);

                return match;
            }

            gantt.attachEvent("onBeforeTaskDisplay", function(id, task) {
                if (!filterValue) {
                    return true;
                }
                return filterLogic(task);
            });
        }

        filter();

        //user
        gantt.form_blocks["ownerselect"] = {
            render: function(sns) {
                var height = (sns.height || "23") + "px";
                var html = "<div class='gantt_cal_ltext gantt_cal_chosen gantt_cal_multiselect' style='height:" +
                    height + ";'><select data-placeholder='...' class='chosen-select'>";
                if (sns.options) {
                    for (var i = 0; i < sns.options.length; i++) {
                        if (sns.unassigned_value !== undefined && sns.options[i].key == sns.unassigned_value) {
                            continue;
                        }
                        html += "<option value='" + sns.options[i].key + "'>" + sns.options[i].label + "</option>";
                    }
                }
                html += "</select></div>";
                return html;
            },

            set_value: function(node, value, ev, sns) {
                node.style.overflow = "visible";
                node.parentNode.style.overflow = "visible";
                node.style.display = "inline-block";
                var select = $(node.firstChild);

                if (value) {
                    value = (value + "").split(",");
                    select.val(value);
                } else {
                    select.val([]);
                }

                select.chosen();
                if (sns.onchange) {
                    select.change(function() {
                        sns.onchange.call(this);
                    })
                }
                select.trigger('chosen:updated');
                select.trigger("change");
            },

            get_value: function(node, ev) {
                var value = $(node.firstChild).val();
                return value;
            },

            focus: function(node) {
                $(node.firstChild).focus();
            }
        };

        function findUser(id) {
            var list = gantt.serverList("people");
            for (var i = 0; i < list.length; i++) {
                if (list[i].key == id) {
                    return list[i];
                }
            }
            return null;
        }

        //Gantt Scale Templates
	    gantt.templates.scale_cell_class = function( task, date )
	    {
	        return "scaleHeaderText";
	    };

		gantt.templates.task_class = function( st, end, item )
		{
			return item.$level == 0 ? "gantt_project" : ""
		};

		//Gantt Grid Templates
		gantt.templates.grid_row_class = function( start, end, task )
		{
		   if ( task.$level > 0 )
		   {
		      return "nested_task"
		   }
		   return "";
		};

		gantt.templates.grid_header_class = function( column, config )
		{
		    return "gridHeaderText";
		};

		gantt.templates.grid_indent=function( task )
		{
		    return "<div style='width:5px; float:left; height:100%'></div>"
		};

        // columns definition
        gantt.config.columns = [{
                name: "add",
                label: "",
                width: 44,
                align: "left"
            },
            {
                name: "text",
                label: "Task name",
                tree: true,
                min_width: 180,
            },
            {
                name: "duration",
                label: "Duration",
                align: "center",
                min_width: 50,
            },
            {
                name: "owner",
                align: "center",
                width: 75,
                label: "Owner",
                template: function(task) {
                    if (task.type == gantt.config.types.project) {
                        return "";
                    }

                    var result = "";

                    var owners = [task.owners];

                    if (!owners || !owners.length) {
                        return "-";
                    }

                    if (owners.length == 1) {
                        var owner = findUser(owners[0]);
                        if (!owner) {
                            return "-";
                        }
                        return owner.label;
                    }

                    owners.forEach(function(ownerId) {
                        var owner = findUser(ownerId);
                        if (!owner)
                            return;
                        result += "<div class='owner-label' title='" + owner.label + "'>" + owner.label
                            .substr(0, 1) + "</div>";

                    });

                    return result;
                },
                resize: true
            },
            {
                name: "jumlah_lembar_cetak",
                label: "Jumlah LC",
                align: "center",
                min_width: 80,
            },
            {
                name: "start_date",
                label: "Start time",
                align: "center",
                min_width: 80,
            },
            {
                name: "end_date",
                label: "End time",
                align: "center",
                min_width: 80,
            },
            {
                name: "priority",
                label: "Priority",
                align: "center",
                min_width: 80,
                template: function(obj) {
                    if (obj.priority == 1)
                        return "Normal";

                    if (obj.priority == 2)
                        return "Medium";

                    return "High";
                }
            },

            // {
            //     name: "machine",
            //     label: "Machine",
            //     align: "center",
            //     min_width: 130,
            //     template: function(obj) {
            //         if (obj.machine == "1")
            //             return "Machine 1";

            //         if (obj.machine == "2")
            //             return "Machine 2";

            //         return "-";
            //     }
            // },

            {
                name: "type",
                label: "Type",
                align: "center",
                min_width: 80,
                template: function(obj) {
                    if (obj.type == null)
                        return "project";

                    if (obj.type == "task")
                        return "task";

                    return "-";
                }
            },
            {
                name: "spknumber",
                label: "SPK",
                align: "center",
                min_width: 80,
            },
            // {
            //     name: "add",
            //     label: "",
            // }
        ];

        gantt.locale.labels.section_priority = "Priority";
        gantt.locale.labels.section_text = "Deskripsi";
        gantt.locale.labels.section_owner = "Owner";
        gantt.locale.labels.section_jumlah_lembar_cetak = "Jumlah Lembar Cetak";
        gantt.locale.labels.section_machine = "Machine";
        gantt.locale.labels.section_workstep = "Langkah Kerja";

        gantt.config.lightbox.sections = [{
                name: "workstep",
                height: 22,
                map_to: "text",
                type: "select",
                options: gantt.serverList("workstep"),
            },
            {
                name: "priority",
                height: 22,
                map_to: "priority",
                type: "select",
                options: gantt.serverList("priority"),
            },
            {
                name: "type",
                height: 22,
                map_to: "type",
                type: "select",
                options: [{
                    key: "task",
                    label: "Task"
                }, ]
            },
            {
                name: "jumlah_lembar_cetak",
                height: 22,
                map_to: "jumlah_lembar_cetak",
                type: "textarea",
                focus: true,
            },
            {
                name: "owner",
                height: 22,
                type: "ownerselect",
                options: gantt.serverList("people"),
                map_to: "owners"
            },
            {
                name: "machine",
                height: 22,
                map_to: "machine",
                type: "select",
                options: [{
                        key: 1,
                        label: "Machine 1"
                    },
                    {
                        key: 2,
                        label: "Machine 2"
                    },
                    {
                        key: 3,
                        label: "Machine 3"
                    }
                ]
            },
            {
                name: "time",
                height: 25,
                map_to: "auto",
                type: "duration"
            }
        ];

        gantt.init("gantt_here");
        gantt.load("/api/data");

        var dp = new gantt.dataProcessor("/api");
        dp.init(gantt);
        dp.setTransactionMode("REST");
    </script>
@endpush
