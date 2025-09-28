@php

/**
 * Reusable Appointment Slots Component
 * 
 * This component displays appointment slots for doctors with navigation,
 * slot selection, and expandable views using PHP-based rendering.
 * 
 * Required parameters:
 * - $doctor: Doctor array with appointments data
 * - $componentId: Unique identifier for this component instance
 */

// Ensure required parameters are provided
if (!isset($doctor) || !isset($componentId)) {
  throw new Exception('Appointment slots component requires $doctor and $componentId parameters');
}

// Get current page parameters for navigation
$currentOffset = (int)($_GET['offset_' . $componentId] ?? 0);
$expandedDay = $_GET['expanded_' . $componentId] ?? '';

/**
 * Process appointments data from database to match the expected structure
 */
if (!function_exists('processAppointmentsData')) {
  function processAppointmentsData($appointments)
  {
    $processedData = [];
    
    // Handle both array format (static data) and Laravel Collection (database data)
    if (is_object($appointments) && method_exists($appointments, 'toArray')) {
      // Convert Laravel Collection to array
      $appointments = $appointments->toArray();
    }
    
    // Check if appointments is in old format (associative array with date keys) or new format (indexed array from DB)
    if (!empty($appointments) && !is_numeric(array_keys($appointments)[0])) {
      // Old format: associative array with date keys like 'd/m/Y'
      foreach ($appointments as $dateKey => $slots) {
        $date = DateTime::createFromFormat('d/m/Y', $dateKey);
        if (!$date) {
          continue;
        }

        $today = new DateTime();
        $tomorrow = (clone $today)->add(new DateInterval('P1D'));

        if ($date->format('Y-m-d') === $today->format('Y-m-d')) {
          $title = 'Today';
        } elseif ($date->format('Y-m-d') === $tomorrow->format('Y-m-d')) {
          $title = 'Tomorrow';
        } else {
          $title = $date->format('D m/d');
        }

        $visibleSlots = array_slice($slots, 0, 4);
        $moreSlots = array_slice($slots, 4);

        $processedData[] = [
          'key' => $dateKey,
          'title' => $title,
          'date' => $date->format('Y-m-d'),
          'slots' => $visibleSlots,
          'moreSlots' => $moreSlots,
          'hasMore' => count($moreSlots) > 0
        ];
      }
    } else {
      // New format: indexed array from database with date/time/status fields
      $appointmentsByDate = [];
      
      foreach ($appointments as $appointment) {
        $date = $appointment['date'] ?? null;
        $time = $appointment['time'] ?? null;
        $status = $appointment['status'] ?? 'available';
        
        if (!$date || !$time) {
          continue;
        }
        
        // Group appointments by date
        if (!isset($appointmentsByDate[$date])) {
          $appointmentsByDate[$date] = [];
        }
        
        $appointmentsByDate[$date][] = [
          'time' => date('g:i A', strtotime($time)),
          'available' => ($status === 'available')
        ];
      }
      
      // Process grouped appointments
      foreach ($appointmentsByDate as $dateStr => $slots) {
        $date = DateTime::createFromFormat('Y-m-d', $dateStr);
        if (!$date) {
          continue;
        }

        $today = new DateTime();
        $tomorrow = (clone $today)->add(new DateInterval('P1D'));

        if ($date->format('Y-m-d') === $today->format('Y-m-d')) {
          $title = 'Today';
        } elseif ($date->format('Y-m-d') === $tomorrow->format('Y-m-d')) {
          $title = 'Tomorrow';
        } else {
          $title = $date->format('D m/d');
        }

        // Sort slots by time
        usort($slots, function($a, $b) {
          return strtotime($a['time']) - strtotime($b['time']);
        });

        $visibleSlots = array_slice($slots, 0, 4);
        $moreSlots = array_slice($slots, 4);

        $processedData[] = [
          'key' => $date->format('d/m/Y'), // Convert to old format for compatibility
          'title' => $title,
          'date' => $date->format('Y-m-d'),
          'slots' => $visibleSlots,
          'moreSlots' => $moreSlots,
          'hasMore' => count($moreSlots) > 0
        ];
      }
    }

    // Sort by date
    usort($processedData, function($a, $b) {
      return strtotime($a['date']) - strtotime($b['date']);
    });

    return $processedData;
  }
}

// Process the appointments data
$appointmentData = processAppointmentsData($doctor['appointments'] ?? []);
$totalDays = count($appointmentData);

// Calculate visible days (3 at a time)
$daysPerPage = 3;
$maxOffset = max(0, $totalDays - $daysPerPage);
$currentOffset = max(0, min($currentOffset, $maxOffset));
$visibleDays = array_slice($appointmentData, $currentOffset, $daysPerPage);

// Build navigation URLs - Use current URL instead of PHP_SELF for Laravel compatibility
$currentParams = $_GET;
$prevParams = array_merge($currentParams, ['offset_' . $componentId => max(0, $currentOffset - 1)]);
$nextParams = array_merge($currentParams, ['offset_' . $componentId => min($maxOffset, $currentOffset + 1)]);

// Get current URL without query parameters
$currentUrl = strtok($_SERVER["REQUEST_URI"], '?');
$prevUrl = $currentUrl . '?' . http_build_query($prevParams);
$nextUrl = $currentUrl . '?' . http_build_query($nextParams);
@endphp

<!-- Appointment Slots Component -->
<div class="appointment-slots-component" data-component-id="<?php echo htmlspecialchars($componentId); ?>" data-doctor-id="<?php echo htmlspecialchars($doctor['id']); ?>">
  <!-- Navigation and Days Container -->
  <div class="flex items-center justify-between mb-4">
    <!-- Left Navigation Arrow -->
    <button type="button" class="nav-arrow prev-btn <?php echo $currentOffset <= 0 ? 'disabled' : ''; ?>"
      data-component-id="<?php echo htmlspecialchars($componentId); ?>"
      data-current-offset="<?php echo $currentOffset; ?>">
      <div class="flex items-center justify-center w-8 h-8 rounded-full bg-white hover:bg-gray-100 transition-colors shadow-sm border border-gray-200">
        <i class="fas fa-chevron-left text-gray-600 text-sm"></i>
      </div>
    </button>

    <!-- Days Columns Container -->
    <div class="flex-1 mx-2">
      <div class="grid grid-cols-3 gap-3">
        <?php foreach ($visibleDays as $dayIndex => $dayData): ?>
          <div class="day-column" data-day="<?php echo htmlspecialchars($dayData['key']); ?>">
            <!-- Day Header -->
            <div class="day-header">
              <?php echo htmlspecialchars($dayData['title']); ?>
            </div>

            <!-- Day Content -->
            <div class="day-content">
              <div class="slots-container">
                <!-- Visible Time Slots -->
                <?php foreach ($dayData['slots'] as $slot): ?>
                  <div class="time-slot <?php echo $slot['available'] ? 'available' : 'unavailable'; ?>"
                    data-time="<?php echo htmlspecialchars($slot['time']); ?>"
                    data-date="<?php echo htmlspecialchars($dayData['date']); ?>"
                    data-doctor-id="<?php echo htmlspecialchars($doctor['id']); ?>"
                    data-doctor-name="<?php echo htmlspecialchars($doctor['name']); ?>"
                    data-doctor-specialty="<?php echo htmlspecialchars(implode(', ', $doctor['specialties'] ?? [])); ?>">
                    <?php echo htmlspecialchars($slot['time']); ?>
                  </div>
                <?php endforeach; ?>

                <!-- More Time Slots (Hidden by default) -->
                <?php if ($dayData['hasMore']): ?>
                  <?php
                  $isExpanded = ($expandedDay === $dayData['key']);
                  $moreSlots = $dayData['moreSlots'];
                  ?>
                  <?php foreach ($moreSlots as $slot): ?>
                    <div class="time-slot available more-slot <?php echo !$isExpanded ? 'hidden' : ''; ?>"
                      data-time="<?php echo htmlspecialchars($slot['time']); ?>"
                      data-date="<?php echo htmlspecialchars($dayData['date']); ?>"
                      data-doctor-id="<?php echo htmlspecialchars($doctor['id']); ?>"
                      data-doctor-name="<?php echo htmlspecialchars($doctor['name']); ?>"
                      data-doctor-specialty="<?php echo htmlspecialchars(implode(', ', $doctor['specialties'] ?? [])); ?>">
                      <?php echo htmlspecialchars($slot['time']); ?>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <?php if ($dayData['hasMore']): ?>
                <!-- More/Less Link -->
                <?php $isExpanded = ($expandedDay === $dayData['key']); ?>
                <div class="more-link" data-day="<?php echo htmlspecialchars($dayData['key']); ?>" data-expanded="<?php echo $isExpanded ? 'true' : 'false'; ?>">
                  <?php echo $isExpanded ? 'Less' : 'More'; ?>
                </div>

                <!-- Book Button -->
                <div class="book-button" data-day="<?php echo htmlspecialchars($dayData['key']); ?>" data-expanded="<?php echo $isExpanded ? 'true' : 'false'; ?>">
                  <?php echo $isExpanded ? 'LESS' : 'BOOK'; ?>
                </div>
              <?php else: ?>
                <!-- Book Button (when no more slots) -->
                <div class="book-button disabled">
                  BOOK
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>

        <!-- Fill empty slots if less than 3 days -->
        <?php for ($i = count($visibleDays); $i < 3; $i++): ?>
          <div class="day-column empty">
            <div class="day-header bg-gray-300">
              No Slots
            </div>
            <div class="day-content">
              <div class="text-center text-gray-500 text-xs py-4">
                No appointments available
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Right Navigation Arrow -->
    <button type="button" class="nav-arrow next-btn <?php echo $currentOffset >= $maxOffset ? 'disabled' : ''; ?>"
      data-component-id="<?php echo htmlspecialchars($componentId); ?>"
      data-current-offset="<?php echo $currentOffset; ?>"
      data-max-offset="<?php echo $maxOffset; ?>">
      <div class="flex items-center justify-center w-8 h-8 rounded-full bg-white hover:bg-gray-100 transition-colors shadow-sm border border-gray-200">
        <i class="fas fa-chevron-right text-gray-600 text-sm"></i>
      </div>
    </button>
  </div>

  <!-- Footer Label -->
  <div class="text-center text-gray-600 text-xs mt-3">
    Appointment reservation
  </div>
</div>

<style>
  /* Appointment Slots Component Styles */
  .appointment-slots-component .time-slot {
    display: block;
    padding: 4px 8px;
    margin: 2px 0;
    text-align: center;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 12px;
    text-decoration: none;
    min-height: 24px;
    line-height: 1.2;
  }

  .appointment-slots-component .time-slot.available {
    color: #2563eb;
    background-color: transparent;
  }

  .appointment-slots-component .time-slot.available:hover {
    background-color: #eff6ff;
  }

  .appointment-slots-component .time-slot.available.selected {
    background-color: #2563eb;
    color: white;
  }

  .appointment-slots-component .time-slot.unavailable {
    color: #9ca3af;
    text-decoration: line-through;
    cursor: not-allowed;
    pointer-events: none;
  }

  .appointment-slots-component .day-column {
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    background: white;
    min-width: 0;
    width: 100%;
    display: flex;
    flex-direction: column;
  }

  .appointment-slots-component .day-column.empty {
    opacity: 0.5;
  }

  .appointment-slots-component .day-header {
    background-color: #2563eb;
    color: white;
    text-align: center;
    padding: 10px 8px;
    font-weight: 600;
    font-size: 13px;
    flex-shrink: 0;
  }

  .appointment-slots-component .day-content {
    padding: 10px 8px;
    min-height: 220px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .appointment-slots-component .book-button {
    display: block;
    background-color: #dc2626;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
    margin-top: auto;
    text-align: center;
    text-decoration: none;
    min-height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .appointment-slots-component .book-button:hover {
    background-color: #b91c1c;
  }

  .appointment-slots-component .book-button.disabled {
    background-color: #9ca3af;
    cursor: not-allowed;
    pointer-events: none;
  }

  .appointment-slots-component .more-link {
    color: #2563eb;
    font-size: 11px;
    cursor: pointer;
    text-align: center;
    padding: 5px 0;
    margin: 5px 0;
    text-decoration: none;
    flex-shrink: 0;
  }

  .appointment-slots-component .more-link:hover {
    text-decoration: underline;
  }

  .appointment-slots-component .slots-container {
    flex: 1;
    margin-bottom: 10px;
    min-height: 120px;
  }

  .appointment-slots-component .more-slot.hidden {
    display: none;
  }

  .appointment-slots-component .nav-arrow.disabled {
    opacity: 0.5;
    pointer-events: none;
    cursor: not-allowed;
  }

  .appointment-slots-component .nav-arrow:not(.disabled):hover {
    transform: scale(1.05);
  }

  .appointment-slots-component .nav-arrow {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    flex-shrink: 0;
  }

  /* Grid layout improvements */
  .appointment-slots-component .grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    align-items: stretch;
  }

  .appointment-slots-component .grid > * {
    height: 100%;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Store all appointment data for each component
    const appointmentComponents = {};

    // Get appointment data for this component
    const componentId = '<?php echo $componentId; ?>';
    const appointmentData = <?php echo json_encode($appointmentData); ?>;

    appointmentComponents[componentId] = {
      data: appointmentData,
      currentOffset: <?php echo $currentOffset; ?>,
      maxOffset: <?php echo max(0, $totalDays - $daysPerPage); ?>,
      expandedDays: new Set()
    };

    // Initialize expanded days from current state
    <?php if ($expandedDay): ?>
      appointmentComponents[componentId].expandedDays.add('<?php echo $expandedDay; ?>');
    <?php endif; ?>

    function renderComponent(compId) {
      const component = appointmentComponents[compId];
      const container = document.querySelector(`[data-component-id="${compId}"] .grid`);
      const visibleDays = component.data.slice(component.currentOffset, component.currentOffset + 3);

      container.innerHTML = '';

      // Render each day
      visibleDays.forEach(dayData => {
        const isExpanded = component.expandedDays.has(dayData.key);

        const dayColumn = document.createElement('div');
        dayColumn.className = 'day-column';
        dayColumn.dataset.day = dayData.key;

        dayColumn.innerHTML = `
        <div class="day-header">${dayData.title}</div>
        <div class="day-content">
          <div class="slots-container">
            ${dayData.slots.map(slot => `
              <div class="time-slot ${slot.available ? 'available' : 'unavailable'}"
                   data-time="${slot.time}"
                   data-date="${dayData.date}"
                   data-doctor-id="<?php echo htmlspecialchars($doctor['id']); ?>"
                   data-doctor-name="<?php echo htmlspecialchars($doctor['name']); ?>"
                   data-doctor-specialty="<?php echo htmlspecialchars(implode(', ', $doctor['specialties'] ?? [])); ?>">
                ${slot.time}
              </div>
            `).join('')}
            ${dayData.moreSlots ? dayData.moreSlots.map(slot => `
              <div class="time-slot available more-slot ${!isExpanded ? 'hidden' : ''}"
                   data-time="${slot.time}"
                   data-date="${dayData.date}"
                   data-doctor-id="<?php echo htmlspecialchars($doctor['id']); ?>"
                   data-doctor-name="<?php echo htmlspecialchars($doctor['name']); ?>"
                   data-doctor-specialty="<?php echo htmlspecialchars(implode(', ', $doctor['specialties'] ?? [])); ?>">
                ${slot.time}
              </div>
            `).join('') : ''}
          </div>
          ${dayData.hasMore ? `
            <div class="more-link" data-day="${dayData.key}" data-expanded="${isExpanded}">
              ${isExpanded ? 'Less' : 'More'}
            </div>
            <div class="book-button" data-day="${dayData.key}" data-expanded="${isExpanded}">
              ${isExpanded ? 'LESS' : 'BOOK'}
            </div>
          ` : `
            <div class="book-button disabled">BOOK</div>
          `}
        </div>
      `;

        container.appendChild(dayColumn);
      });

      // Fill empty slots if needed
      for (let i = visibleDays.length; i < 3; i++) {
        const emptyColumn = document.createElement('div');
        emptyColumn.className = 'day-column empty';
        emptyColumn.innerHTML = `
        <div class="day-header bg-gray-300">No Slots</div>
        <div class="day-content">
          <div class="text-center text-gray-500 text-xs py-4">
            No appointments available
          </div>
        </div>
      `;
        container.appendChild(emptyColumn);
      }

      // Update navigation buttons
      const prevBtn = document.querySelector(`[data-component-id="${compId}"].prev-btn`);
      const nextBtn = document.querySelector(`[data-component-id="${compId}"].next-btn`);

      if (prevBtn) {
        prevBtn.classList.toggle('disabled', component.currentOffset <= 0);
      }
      if (nextBtn) {
        nextBtn.classList.toggle('disabled', component.currentOffset >= component.maxOffset);
      }

      // Reattach event listeners
      attachEventListeners(compId);
    }

    function attachEventListeners(compId) {
      const componentElement = document.querySelector(`[data-component-id="${compId}"]`);

      // Navigation buttons
      const prevBtn = componentElement.querySelector('.prev-btn');
      const nextBtn = componentElement.querySelector('.next-btn');

      if (prevBtn) {
        prevBtn.onclick = function() {
          if (appointmentComponents[compId].currentOffset > 0) {
            appointmentComponents[compId].currentOffset--;
            renderComponent(compId);
          }
        };
      }

      if (nextBtn) {
        nextBtn.onclick = function() {
          if (appointmentComponents[compId].currentOffset < appointmentComponents[compId].maxOffset) {
            appointmentComponents[compId].currentOffset++;
            renderComponent(compId);
          }
        };
      }

      // Time slot clicks
      componentElement.querySelectorAll('.time-slot.available').forEach(slot => {
        slot.onclick = function() {
          if (this.classList.contains('unavailable')) return;

          // Remove previous selections
          componentElement.querySelectorAll('.time-slot.selected').forEach(s => {
            s.classList.remove('selected');
          });

          // Add selection to clicked slot
          this.classList.add('selected');

          // Build URL and redirect to Laravel route
          const params = new URLSearchParams({
            doctor_id: this.dataset.doctorId,
            date: this.dataset.date,
            time: this.dataset.time,
            // doctor_name: this.dataset.doctorName,
            // doctor_specialty: this.dataset.doctorSpecialty
          });

          window.location.href = '{{ url("/create-reservation") }}?' + params.toString();
        };
      });

      // More/Less links
      componentElement.querySelectorAll('.more-link').forEach(link => {
        link.onclick = function() {
          const dayKey = this.dataset.day;
          const dayColumn = this.closest('.day-column');
          const moreSlots = dayColumn.querySelectorAll('.more-slot');
          const isExpanded = appointmentComponents[compId].expandedDays.has(dayKey);

          if (isExpanded) {
            appointmentComponents[compId].expandedDays.delete(dayKey);
            moreSlots.forEach(slot => slot.classList.add('hidden'));
            this.textContent = 'More';
            this.dataset.expanded = 'false';
          } else {
            appointmentComponents[compId].expandedDays.add(dayKey);
            moreSlots.forEach(slot => slot.classList.remove('hidden'));
            this.textContent = 'Less';
            this.dataset.expanded = 'true';
          }

          // Update book button
          const bookButton = dayColumn.querySelector('.book-button');
          if (bookButton) {
            bookButton.textContent = isExpanded ? 'BOOK' : 'LESS';
            bookButton.dataset.expanded = isExpanded ? 'false' : 'true';
          }
        };
      });

      // Book buttons
      componentElement.querySelectorAll('.book-button:not(.disabled)').forEach(btn => {
        btn.onclick = function() {
          const dayKey = this.dataset.day;
          if (!dayKey) return;

          const dayColumn = this.closest('.day-column');
          const moreLink = dayColumn.querySelector('.more-link');
          const moreSlots = dayColumn.querySelectorAll('.more-slot');
          const isExpanded = appointmentComponents[compId].expandedDays.has(dayKey);

          if (isExpanded) {
            appointmentComponents[compId].expandedDays.delete(dayKey);
            moreSlots.forEach(slot => slot.classList.add('hidden'));
            if (moreLink) {
              moreLink.textContent = 'More';
              moreLink.dataset.expanded = 'false';
            }
            this.textContent = 'BOOK';
            this.dataset.expanded = 'false';
          } else {
            appointmentComponents[compId].expandedDays.add(dayKey);
            moreSlots.forEach(slot => slot.classList.remove('hidden'));
            if (moreLink) {
              moreLink.textContent = 'Less';
              moreLink.dataset.expanded = 'true';
            }
            this.textContent = 'LESS';
            this.dataset.expanded = 'true';
          }
        };
      });
    }

    // Initial attachment of event listeners
    attachEventListeners(componentId);
  });
</script>